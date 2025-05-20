<?php
class Projet {
    private $conn;
    private $table_name = "projets";
    
    public $id;
    public $salarie_id;
    public $nom;
    public $objectif;
    public $date_debut;
    public $date_fin;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Récupérer touts les projets avec infos salarié
    public function read() {
        $query = "SELECT c.nom, c.prenom, o.id, o.salarie_id, o.objectif, o.date_debut, o.date_fin 
                  FROM " . $this->table_name . " o
                  LEFT JOIN salaries c ON o.salarie_id = c.id
                  ORDER BY o.date_debut DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    // Récupérer un projet par son ID
    public function readOne() {
        $query = "SELECT c.nom, c.prenom, o.id, o.salarie_id, o.objectif, o.date_debut, o.date_fin 
                  FROM " . $this->table_name . " o
                  LEFT JOIN salaries c ON o.salarie_id = c.id
                  WHERE o.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->salarie_id = $row['salarie_id'];
            $this->objectif = $row['objectif'];
            $this->date_debut = $row['date_debut'];
            $this->date_fin = $row['date_fin'];
            return true;
        }
        return false;
    }
    
    // Créer un nouveau projet
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 (salarie_id, objectif, date_debut, date_fin) 
                 VALUES (?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->salarie_id);
        $stmt->bindParam(2, $this->objectif);
        $stmt->bindParam(3, $this->date_debut);
        $stmt->bindParam(4, $this->date_fin);
        
        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }
    
    // Mettre à jour un projet
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                 SET salarie_id = ?, objectif = ?, date_debut = ?, date_fin = ? 
                 WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->salarie_id);
        $stmt->bindParam(2, $this->objectif);
        $stmt->bindParam(3, $this->date_debut);
        $stmt->bindParam(4, $this->date_fin);
        $stmt->bindParam(5, $this->id);
        
        return $stmt->execute();
    }
    
    // Supprimer un projet
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        
        return $stmt->execute();
    }
    
    // Récupérer les projets d'un salarié
    public function readByClient($salarie_id) {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE salarie_id = ? 
                  ORDER BY date_debut DESC";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $salarie_id);
        $stmt->execute();
        
        return $stmt;
    }
}
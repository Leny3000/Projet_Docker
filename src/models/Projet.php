<?php
class Projet {
    private $conn;
    private $table_name = "projets";
    
    public $id;
    public $nom;
    public $objectif;
    public $date_debut;
    public $date_fin;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Récupérer tous les projets
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY nom";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    // Récupérer un projet par son ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->nom = $row['nom'];
            $this->prenom = $row['objectif'];
            $this->email = $row['date_debut'];
            $this->date_inscription = $row['date_fin'];
            return true;
        }
        return false;
    }
    
    // Créer un nouveau projet
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 (nom, , date_debut, date_fin) 
                 VALUES (?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        
        // Protection contre les injections SQL
        $stmt->bindParam(1, $this->nom);
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
                 SET nom = ?, objectif = ?, date_debut = ?, date_fin = ? 
                 WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->nom);
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
}
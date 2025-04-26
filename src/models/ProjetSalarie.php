<?php
class ProjetSalarie {
    private $conn;
    private $table_name = "projet_salarie";
    
    public $id;
    public $projet_id;
    public $salarie_id;
    public $role;
    public $date_affectation;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Récupérer toutes les affectations de salariés aux projets
    public function read() {
        $query = "SELECT 
                    ps.id, 
                    ps.projet_id, 
                    ps.salarie_id, 
                    ps.role, 
                    ps.date_affectation,
                    s.nom AS salarie_nom,
                    s.prenom AS salarie_prenom,
                    s.email AS salarie_email,
                    p.nom AS projet_nom,
                    p.objectif
                  FROM " . $this->table_name . " ps
                  LEFT JOIN salaries s ON ps.salarie_id = s.id
                  LEFT JOIN projets p ON ps.projet_id = p.id
                  ORDER BY ps.date_affectation DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    // Récupérer une affectation par son ID
    public function readOne() {
        $query = "SELECT 
                    ps.id, 
                    ps.projet_id, 
                    ps.salarie_id, 
                    ps.role, 
                    ps.date_affectation,
                    s.nom AS salarie_nom,
                    s.prenom AS salarie_prenom,
                    s.email AS salarie_email,
                    p.nom AS projet_nom,
                    p.objectif
                  FROM " . $this->table_name . " ps
                  LEFT JOIN salaries s ON ps.salarie_id = s.id
                  LEFT JOIN projets p ON ps.projet_id = p.id
                  WHERE ps.id = ?
                  LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->projet_id = $row['projet_id'];
            $this->salarie_id = $row['salarie_id'];
            $this->role = $row['role'];
            $this->date_affectation = $row['date_affectation'];
            return true;
        }
        return false;
    }
    
    // Créer une nouvelle affectation projet-salarié
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (projet_id, salarie_id, role, date_affectation) 
                  VALUES (:projet_id, :salarie_id, :role, :date_affectation)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':projet_id', $this->projet_id);
        $stmt->bindParam(':salarie_id', $this->salarie_id);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':date_affectation', $this->date_affectation);
        
        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }
    
    // Mettre à jour une affectation
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET projet_id = :projet_id, 
                      salarie_id = :salarie_id, 
                      role = :role, 
                      date_affectation = :date_affectation 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':projet_id', $this->projet_id);
        $stmt->bindParam(':salarie_id', $this->salarie_id);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':date_affectation', $this->date_affectation);
        $stmt->bindParam(':id', $this->id);
        
        return $stmt->execute();
    }
    
    // Supprimer une affectation
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        
        return $stmt->execute();
    }
    
    // Récupérer toutes les affectations d'un salarié
    public function readBySalarie($salarie_id) {
        $query = "SELECT 
                    ps.id, 
                    ps.projet_id, 
                    ps.salarie_id, 
                    ps.role, 
                    ps.date_affectation,
                    p.nom AS projet_nom,
                    p.objectif
                  FROM " . $this->table_name . " ps
                  LEFT JOIN projets p ON ps.projet_id = p.id
                  WHERE ps.salarie_id = :salarie_id
                  ORDER BY ps.date_affectation DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':salarie_id', $salarie_id);
        $stmt->execute();
        
        return $stmt;
    }
}
?>
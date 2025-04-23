<?php
class Client {
    private $conn;
    private $table_name = "clients";
    
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $date_inscription;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Récupérer tous les clients
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY nom";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    // Récupérer un client par son ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->nom = $row['nom'];
            $this->prenom = $row['prenom'];
            $this->email = $row['email'];
            $this->date_inscription = $row['date_inscription'];
            return true;
        }
        return false;
    }
    
    // Créer un nouveau client
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 (nom, prenom, email, date_inscription) 
                 VALUES (?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        
        // Protection contre les injections SQL
        $stmt->bindParam(1, $this->nom);
        $stmt->bindParam(2, $this->prenom);
        $stmt->bindParam(3, $this->email);
        $stmt->bindParam(4, $this->date_inscription);
        
        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }
    
    // Mettre à jour un client
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                 SET nom = ?, prenom = ?, email = ?, date_inscription = ? 
                 WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->nom);
        $stmt->bindParam(2, $this->prenom);
        $stmt->bindParam(3, $this->email);
        $stmt->bindParam(4, $this->date_inscription);
        $stmt->bindParam(5, $this->id);
        
        return $stmt->execute();
    }
    
    // Supprimer un client
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        
        return $stmt->execute();
    }
}
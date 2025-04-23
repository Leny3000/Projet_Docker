<?php
class Commande {
    private $conn;
    private $table_name = "commandes";
    
    public $id;
    public $client_id;
    public $date_commande;
    public $montant;
    public $statut;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Récupérer toutes les commandes avec infos client
    public function read() {
        $query = "SELECT c.nom, c.prenom, o.id, o.client_id, o.date_commande, o.montant, o.statut 
                  FROM " . $this->table_name . " o
                  LEFT JOIN clients c ON o.client_id = c.id
                  ORDER BY o.date_commande DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    // Récupérer une commande par son ID
    public function readOne() {
        $query = "SELECT c.nom, c.prenom, o.id, o.client_id, o.date_commande, o.montant, o.statut 
                  FROM " . $this->table_name . " o
                  LEFT JOIN clients c ON o.client_id = c.id
                  WHERE o.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->client_id = $row['client_id'];
            $this->date_commande = $row['date_commande'];
            $this->montant = $row['montant'];
            $this->statut = $row['statut'];
            return true;
        }
        return false;
    }
    
    // Créer une nouvelle commande
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 (client_id, date_commande, montant, statut) 
                 VALUES (?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->client_id);
        $stmt->bindParam(2, $this->date_commande);
        $stmt->bindParam(3, $this->montant);
        $stmt->bindParam(4, $this->statut);
        
        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }
    
    // Mettre à jour une commande
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                 SET client_id = ?, date_commande = ?, montant = ?, statut = ? 
                 WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->client_id);
        $stmt->bindParam(2, $this->date_commande);
        $stmt->bindParam(3, $this->montant);
        $stmt->bindParam(4, $this->statut);
        $stmt->bindParam(5, $this->id);
        
        return $stmt->execute();
    }
    
    // Supprimer une commande
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        
        return $stmt->execute();
    }
    
    // Récupérer les commandes d'un client
    public function readByClient($client_id) {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE client_id = ? 
                  ORDER BY date_commande DESC";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $client_id);
        $stmt->execute();
        
        return $stmt;
    }
}
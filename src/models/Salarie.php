<?php
class Salarie {
    private $conn;
    private $table_name = "salaries";
    
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $role;
    public $date_inscription;
    
    public function __construct($db) {
        if ($db === null) {
            throw new Exception("Connexion à la base de données non initialisée.");
        }
        $this->conn = $db;
    }

    private function isValid() {
        return !empty($this->nom) && !empty($this->prenom) && filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY nom";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->nom = $row['nom'];
            $this->prenom = $row['prenom'];
            $this->email = $row['email'];
            $this->role = $row['role'];
            $this->date_inscription = $row['date_inscription'];
            return $row;
        }
        return false;
    }

    public function create() {
        if (!$this->isValid()) {
            error_log("Validation échouée (Salarie::create)");
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " 
                 (nom, prenom, email, role, date_inscription) 
                 VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->nom);
        $stmt->bindParam(2, $this->prenom);
        $stmt->bindParam(3, $this->email);
        $stmt->bindParam(4, $this->role);
        $stmt->bindParam(5, $this->date_inscription);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        } else {
            error_log("Erreur SQL (Salarie::create) : " . implode(", ", $stmt->errorInfo()));
            return false;
        }
    }

    public function update() {
        if (!$this->isValid()) {
            error_log("Validation échouée (Salarie::update)");
            return false;
        }

        $query = "UPDATE " . $this->table_name . " 
                 SET nom = ?, prenom = ?, email = ?, role = ?, date_inscription = ? 
                 WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->nom);
        $stmt->bindParam(2, $this->prenom);
        $stmt->bindParam(3, $this->email);
        $stmt->bindParam(4, $this->role);
        $stmt->bindParam(5, $this->date_inscription);
        $stmt->bindParam(6, $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Erreur SQL (Salarie::update) : " . implode(", ", $stmt->errorInfo()));
            return false;
        }
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Erreur SQL (Salarie::delete) : " . implode(", ", $stmt->errorInfo()));
            return false;
        }
    }
}
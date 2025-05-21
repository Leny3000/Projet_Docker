<?php
class Projet {
    private $conn;
    private $table_name = "projets";
    
    public $id;
    public $salarie_id;
    public $nom_projet;
    public $objectif;
    public $date_debut;
    public $date_fin;

    public function __construct($db) {
        if ($db === null) {
            throw new Exception("Connexion à la base de données non initialisée.");
        }
        $this->conn = $db;
    }

    private function isValid() {
        return !empty($this->salarie_id) && !empty($this->nom_projet) && !empty($this->objectif)
            && $this->isValidDate($this->date_debut)
            && $this->isValidDate($this->date_fin);
    }

    private function isValidDate($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    public function read() {
        $query = "SELECT c.nom, c.prenom, o.id, o.salarie_id, o.nom_projet, o.objectif, o.date_debut, o.date_fin 
                  FROM " . $this->table_name . " o
                  LEFT JOIN salaries c ON o.salarie_id = c.id
                  ORDER BY o.date_debut DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT c.nom, c.prenom, o.id, o.salarie_id, o.nom_projet, o.objectif, o.date_debut, o.date_fin 
                  FROM " . $this->table_name . " o
                  LEFT JOIN salaries c ON o.salarie_id = c.id
                  WHERE o.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->salarie_id = $row['salarie_id'];
            $this->nom_projet = $row['nom_projet'];
            $this->objectif = $row['objectif'];
            $this->date_debut = $row['date_debut'];
            $this->date_fin = $row['date_fin'];
            return true;
        }
        return false;
    }

    public function create() {
        if (!$this->isValid()) {
            error_log("Validation échouée (Projet::create)");
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " 
                  (salarie_id, nom_projet, objectif, date_debut, date_fin) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->salarie_id);
        $stmt->bindParam(2, $this->nom_projet);
        $stmt->bindParam(3, $this->objectif);
        $stmt->bindParam(4, $this->date_debut);
        $stmt->bindParam(5, $this->date_fin);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        } else {
            error_log("Erreur SQL (Projet::create) : " . implode(", ", $stmt->errorInfo()));
            return false;
        }
    }

    public function update() {
        if (!$this->isValid()) {
            error_log("Validation échouée (Projet::update)");
            return false;
        }

        $query = "UPDATE " . $this->table_name . " 
                 SET salarie_id = ?, nom_projet = ?, objectif = ?, date_debut = ?, date_fin = ? 
                 WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->salarie_id);
        $stmt->bindParam(2, $this->nom_projet);
        $stmt->bindParam(3, $this->objectif);
        $stmt->bindParam(4, $this->date_debut);
        $stmt->bindParam(5, $this->date_fin);
        $stmt->bindParam(6, $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Erreur SQL (Projet::update) : " . implode(", ", $stmt->errorInfo()));
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
            error_log("Erreur SQL (Projet::delete) : " . implode(", ", $stmt->errorInfo()));
            return false;
        }
    }

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
<?php
require_once __DIR__ . '/../config/Database.php';

class SalarieController {

    private function sendJson($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getAll() {
        try {
            $db = Database::connect();
            $stmt = $db->query("SELECT * FROM salaries");
            $this->sendJson($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            $this->sendJson(['error' => 'Erreur de récupération : ' . $e->getMessage()], 500);
        }
    }

    public function getOne($id) {
        try {
            $db = Database::connect();
            $stmt = $db->prepare("SELECT * FROM salaries WHERE id = ?");
            $stmt->execute([$id]);
            $salarie = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($salarie) {
                $this->sendJson($salarie);
            } else {
                $this->sendJson(['error' => 'Salarié non trouvé'], 404);
            }
        } catch (PDOException $e) {
            $this->sendJson(['error' => 'Erreur de récupération : ' . $e->getMessage()], 500);
        }
    }

    public function index() {
        $this->getAll(); // Par défaut, on affiche tous les salariés
    }

    public function create($data) {
        try {
            if (!isset($data['nom'], $data['prenom'], $data['email'])) {
                return $this->sendJson(['error' => 'Données manquantes'], 400);
            }

            $db = Database::connect();
            $stmt = $db->prepare("INSERT INTO salaries (nom, prenom, email) VALUES (?, ?, ?)");
            $stmt->execute([$data['nom'], $data['prenom'], $data['email']]);
            $this->sendJson(['message' => 'Salarié créé avec succès'], 201);
        } catch (PDOException $e) {
            $this->sendJson(['error' => 'Erreur de création : ' . $e->getMessage()], 500);
        }
    }

    public function update($id, $data) {
        try {
            if (!isset($data['nom'], $data['prenom'], $data['email'])) {
                return $this->sendJson(['error' => 'Données manquantes'], 400);
            }

            $db = Database::connect();
            $stmt = $db->prepare("UPDATE salaries SET nom = ?, prenom = ?, email = ? WHERE id = ?");
            $stmt->execute([$data['nom'], $data['prenom'], $data['email'], $id]);
            $this->sendJson(['message' => 'Salarié mis à jour avec succès']);
        } catch (PDOException $e) {
            $this->sendJson(['error' => 'Erreur de mise à jour : ' . $e->getMessage()], 500);
        }
    }

    public function delete($id) {
        try {
            $db = Database::connect();
            $stmt = $db->prepare("DELETE FROM salaries WHERE id = ?");
            $stmt->execute([$id]);
            $this->sendJson(['message' => 'Salarié supprimé avec succès']);
        } catch (PDOException $e) {
            $this->sendJson(['error' => 'Erreur de suppression : ' . $e->getMessage()], 500);
        }
    }
}
<?php
require_once __DIR__ . '/../config/Database.php';

class ProjetController {

    private function sendJson($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getAll() {
        try {
            $db = Database::connect();
            $stmt = $db->query("SELECT * FROM projets");
            $this->sendJson($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            $this->sendJson(['error' => 'Erreur lors de la récupération : ' . $e->getMessage()], 500);
        }
    }

    public function getOne($id) {
        try {
            $db = Database::connect();
            $stmt = $db->prepare("SELECT * FROM projets WHERE id = ?");
            $stmt->execute([$id]);
            $projet = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($projet) {
                $this->sendJson($projet);
            } else {
                $this->sendJson(['error' => 'Projet non trouvé'], 404);
            }
        } catch (PDOException $e) {
            $this->sendJson(['error' => 'Erreur lors de la récupération : ' . $e->getMessage()], 500);
        }
    }

    public function index() {
        $this->getAll(); // Affiche tous les projets par défaut
    }

    public function create($data) {
        try {
            if (!isset($data['nom'], $data['objectif'], $data['date_debut'], $data['date_fin'])) {
                return $this->sendJson(['error' => 'Données manquantes'], 400);
            }

            $db = Database::connect();
            $stmt = $db->prepare("INSERT INTO projets (nom, objectif, date_debut, date_fin) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $data['nom'],
                $data['objectif'],
                $data['date_debut'],
                $data['date_fin']
            ]);
            $this->sendJson(['message' => 'Projet créé avec succès'], 201);
        } catch (PDOException $e) {
            $this->sendJson(['error' => 'Erreur lors de la création : ' . $e->getMessage()], 500);
        }
    }

    public function update($id, $data) {
        try {
            if (!isset($data['nom'], $data['objectif'], $data['date_debut'], $data['date_fin'])) {
                return $this->sendJson(['error' => 'Données manquantes'], 400);
            }

            $db = Database::connect();
            $stmt = $db->prepare("UPDATE projets SET nom = ?, objectif = ?, date_debut = ?, date_fin = ? WHERE id = ?");
            $stmt->execute([
                $data['nom'],
                $data['objectif'],
                $data['date_debut'],
                $data['date_fin'],
                $id
            ]);
            $this->sendJson(['message' => 'Projet mis à jour avec succès']);
        } catch (PDOException $e) {
            $this->sendJson(['error' => 'Erreur lors de la mise à jour : ' . $e->getMessage()], 500);
        }
    }

    public function delete($id) {
        try {
            $db = Database::connect();
            $stmt = $db->prepare("DELETE FROM projets WHERE id = ?");
            $stmt->execute([$id]);
            $this->sendJson(['message' => 'Projet supprimé avec succès']);
        } catch (PDOException $e) {
            $this->sendJson(['error' => 'Erreur lors de la suppression : ' . $e->getMessage()], 500);
        }
    }
}
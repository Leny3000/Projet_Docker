<?php
require_once __DIR__ . '/../config/Database.php';

class ProjetController {
    public function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM projets");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getOne($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM projets WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO projets (nom, objectif, date_debut, date_fin) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['nom'], $data['objectif'], $data['date_debut'], $data['date_fin']]);
        echo json_encode(['message' => 'Projet créé']);
    }

    public function update($id, $data) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE projets SET nom = ?, objectif = ?, date_debut = ?, date_fin = ? WHERE id = ?");
        $stmt->execute([$data['nom'], $data['objectif'], $data['date_debut'], $data['date_fin'], $id]);
        echo json_encode(['message' => 'Projet mis à jour']);
    }

    public function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM projets WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['message' => 'Projet supprimé']);
    }
}
?>
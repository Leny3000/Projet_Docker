<?php
require_once __DIR__ . '/../config/Database.php';

class EntityController {
    public function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM entities");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getOne($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM entities WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO entities (nom, description) VALUES (?, ?)");
        $stmt->execute([$data['nom'], $data['description']]);
        echo json_encode(['message' => 'Entity créée']);
    }

    public function update($id, $data) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE entities SET nom = ?, description = ? WHERE id = ?");
        $stmt->execute([$data['nom'], $data['description'], $id]);
        echo json_encode(['message' => 'Entity mise à jour']);
    }

    public function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM entities WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['message' => 'Entity supprimée']);
    }
}
?>
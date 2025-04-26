<?php
require_once __DIR__ . '/../config/Database.php';

class SalarieController {
    public function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM salaries");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getOne($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM salaries WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO salaries (nom, prenom, email) VALUES (?, ?, ?)");
        $stmt->execute([$data['nom'], $data['prenom'], $data['email']]);
        echo json_encode(['message' => 'Salarié créé']);
    }

    public function update($id, $data) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE salaries SET nom = ?, prenom = ?, email = ? WHERE id = ?");
        $stmt->execute([$data['nom'], $data['prenom'], $data['email'], $id]);
        echo json_encode(['message' => 'Salarié mis à jour']);
    }

    public function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM salaries WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['message' => 'Salarié supprimé']);
    }
}
?>
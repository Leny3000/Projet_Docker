<?php
require_once __DIR__ . '/../models/Database.php';

class ProjetSalarieController {
    public function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM projet_salarie");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getOne($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM projet_salarie WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO projet_salarie (projet_id, salarie_id, role, date_affectation) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['projet_id'], $data['salarie_id'], $data['role'], $data['date_affectation']]);
        echo json_encode(['message' => 'Affectation créée']);
    }

    public function update($id, $data) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE projet_salarie SET projet_id = ?, salarie_id = ?, role = ?, date_affectation = ? WHERE id = ?");
        $stmt->execute([$data['projet_id'], $data['salarie_id'], $data['role'], $data['date_affectation'], $id]);
        echo json_encode(['message' => 'Affectation mise à jour']);
    }

    public function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM projet_salarie WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['message' => 'Affectation supprimée']);
    }
}
?>
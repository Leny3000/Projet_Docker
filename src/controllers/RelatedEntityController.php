<?php
require_once __DIR__ . '/../config/Database.php';

class RelatedEntityController {
    public function getAllByEntity($entityId) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM related_entities WHERE entity_id = ?");
        $stmt->execute([$entityId]);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getOne($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM related_entities WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO related_entities (entity_id, nom, statut) VALUES (?, ?, ?)");
        $stmt->execute([$data['entity_id'], $data['nom'], $data['statut']]);
        echo json_encode(['message' => 'RelatedEntity créée']);
    }

    public function update($id, $data) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE related_entities SET nom = ?, statut = ? WHERE id = ?");
        $stmt->execute([$data['nom'], $data['statut'], $id]);
        echo json_encode(['message' => 'RelatedEntity mise à jour']);
    }

    public function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM related_entities WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['message' => 'RelatedEntity supprimée']);
    }
}
?>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/utils/database.php';

function findOneWeapon(string $id) {
    $db = getDatabaseConnection();
    $sql = "SELECT id, type, damage FROM weapon WHERE id = :id";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute(['id' => $id]);
    if ($res) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return null;
}
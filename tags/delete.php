<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM Tags WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;

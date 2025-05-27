<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();
$id = $_GET['id'] ?? null;

$stmt = $conn->prepare("SELECT * FROM Tags WHERE id = ?");
$stmt->execute([$id]);
$tag = $stmt->fetch(PDO::FETCH_ASSOC);

require_once '../bootstrap/header.php';
?>

<div class="container mt-4">
    <h1>Detalii tag</h1>
    <?php if ($tag): ?>
        <ul class="list-group">
            <li class="list-group-item"><strong>ID:</strong> <?= $tag['id'] ?></li>
            <li class="list-group-item"><strong>Nume:</strong> <?= htmlspecialchars($tag['name']) ?></li>
            <li class="list-group-item"><strong>Status:</strong> <?= htmlspecialchars($tag['status']) ?></li>
        </ul>
    <?php else: ?>
        <div class="alert alert-warning">Tagul nu a fost găsit.</div>
    <?php endif; ?>
    <a href="index.php" class="btn btn-secondary mt-3">Înapoi</a>
</div>

<?php require_once '../bootstrap/footer.php'; ?>

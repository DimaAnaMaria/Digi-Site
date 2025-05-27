<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();
$id = $_GET['id'] ?? null;

$stmt = $conn->prepare("SELECT * FROM Authors WHERE id = ?");
$stmt->execute([$id]);
$author = $stmt->fetch(PDO::FETCH_ASSOC);

require_once '../bootstrap/header.php';
?>

<div class="container mt-4">
    <h1>Detalii autor</h1>
    <?php if ($author): ?>
        <ul class="list-group">
            <li class="list-group-item"><strong>ID:</strong> <?= $author['id'] ?></li>
            <li class="list-group-item"><strong>Nume:</strong> <?= htmlspecialchars($author['name']) ?></li>
            <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($author['email']) ?></li>
            <li class="list-group-item"><strong>Biografie:</strong> <br><?= nl2br(htmlspecialchars($author['bio'])) ?></li>
        </ul>
    <?php else: ?>
        <div class="alert alert-warning">Autorul nu a fost găsit.</div>
    <?php endif; ?>
    <a href="index.php" class="btn btn-secondary mt-3">Înapoi</a>
</div>

<?php require_once '../bootstrap/footer.php'; ?>

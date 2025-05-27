<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();
$id = $_GET['id'] ?? null;
$stmt = $conn->prepare("SELECT * FROM Images WHERE id = ?");
$stmt->execute([$id]);
$image = $stmt->fetch(PDO::FETCH_ASSOC);
require_once '../bootstrap/header.php';
?>

    <div class="container mt-4">
        <h1>Detalii imagine</h1>
        <?php if ($image): ?>
            <ul class="list-group">
                <li class="list-group-item"><strong>ID:</strong> <?= $image['id'] ?></li>
                <li class="list-group-item"><strong>URL:</strong> <?= htmlspecialchars($image['url']) ?></li>
                <li class="list-group-item">
                    <strong>Previzualizare:</strong><br>
                    <img src="<?= $image['url'] ?>" width="300" alt="Imagine">
                </li>
            </ul>
        <?php else: ?>
            <div class="alert alert-warning">Imaginea nu a fost găsită.</div>
        <?php endif; ?>
        <a href="index.php" class="btn btn-secondary mt-3">Înapoi</a>
    </div>

<?php require_once '../bootstrap/footer.php'; ?>
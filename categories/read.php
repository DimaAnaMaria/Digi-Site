<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();
$id = $_GET['id'] ?? null;

$stmt = $conn->prepare("SELECT * FROM Categories WHERE id = ?");
$stmt->execute([$id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

require_once '../bootstrap/header.php';
?>

<div class="container mt-4">
    <h1>Detalii categorie</h1>

    <?php if ($category): ?>
        <ul class="list-group">
            <li class="list-group-item"><strong>ID:</strong> <?= $category['id'] ?></li>
            <li class="list-group-item"><strong>Nume:</strong> <?= htmlspecialchars($category['name']) ?></li>
            <li class="list-group-item"><strong>URL:</strong> <?= htmlspecialchars($category['url']) ?></li>
            <li class="list-group-item"><strong>Părinte:</strong> <?= $category['parent_id'] ?? '—' ?></li>
        </ul>
    <?php else: ?>
        <div class="alert alert-danger">Categoria nu a fost găsită.</div>
    <?php endif; ?>

    <a href="index.php" class="btn btn-secondary mt-3">Înapoi</a>
</div>

<?php require_once '../bootstrap/footer.php'; ?>

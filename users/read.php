<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();
$id = $_GET['id'] ?? null;

$stmt = $conn->prepare("SELECT * FROM Users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

require_once '../bootstrap/header.php';
?>

<div class="container mt-4">
    <h1>Detalii utilizator</h1>
    <?php if ($user): ?>
        <ul class="list-group">
            <li class="list-group-item"><strong>ID:</strong> <?= $user['id'] ?></li>
            <li class="list-group-item"><strong>Nume:</strong> <?= htmlspecialchars($user['name']) ?></li>
            <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></li>
            <li class="list-group-item"><strong>Rol:</strong> <?= htmlspecialchars($user['role']) ?></li>
        </ul>
    <?php else: ?>
        <div class="alert alert-warning">Utilizatorul nu a fost găsit.</div>
    <?php endif; ?>
    <a href="index.php" class="btn btn-secondary mt-3">Înapoi</a>
</div>

<?php require_once '../bootstrap/footer.php'; ?>

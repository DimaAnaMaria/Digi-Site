<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $status = $_POST['status'] ?? 'public';

    if (!empty($name)) {
        try {
            $stmt = $conn->prepare("INSERT INTO Tags (name, status) VALUES (?, ?)");
            $stmt->execute([$name, $status]);
            $message = "Tag adăugat!";
        } catch (PDOException $e) {
            $error = "Eroare: " . $e->getMessage();
        }
    } else {
        $error = "Numele tagului este obligatoriu.";
    }
}

require_once '../bootstrap/header.php';
?>

<div class="container mt-4">
    <h1>Adaugă tag</h1>
    <?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nume tag</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="public">Public</option>
                <option value="internal">Internal</option>
            </select>
        </div>
        <button class="btn btn-primary">Salvează</button>
        <a href="index.php" class="btn btn-secondary">Înapoi</a>
    </form>
</div>

<?php require_once '../bootstrap/footer.php'; ?>

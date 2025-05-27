<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();

$id = $_GET['id'] ?? null;
$message = '';
$error = '';

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM Images WHERE id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $url = $_POST['url'] ?? '';
        if (!empty($url)) {
            $stmt = $conn->prepare("UPDATE Images SET url = ? WHERE id = ?");
            $stmt->execute([$url, $id]);
            $message = "Imagine actualizată!";
            $image['url'] = $url;
        } else {
            $error = "URL-ul este obligatoriu.";
        }
    }
}

require_once '../bootstrap/header.php';
?>

    <div class="container mt-4">
        <h1>Editează imaginea</h1>
        <?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
        <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
        <?php if ($image): ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="url" class="form-label">URL Imagine</label>
                    <input type="text" name="url" class="form-control" value="<?= htmlspecialchars($image['url']) ?>" required>
                </div>
                <button class="btn btn-primary">Salvează</button>
                <a href="index.php" class="btn btn-secondary">Înapoi</a>
            </form>
        <?php endif; ?>
    </div>

<?php require_once '../bootstrap/footer.php'; ?>
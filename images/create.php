<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'] ?? '';
    if (!empty($url)) {
        try {
            $stmt = $conn->prepare("INSERT INTO Images (url) VALUES (?)");
            $stmt->execute([$url]);
            $message = "Imagine adăugată!";
        } catch (PDOException $e) {
            $error = "Eroare: " . $e->getMessage();
        }
    } else {
        $error = "URL-ul este obligatoriu.";
    }
}

require_once '../bootstrap/header.php';
?>

    <div class="container mt-4">
        <h1>Adaugă imagine</h1>
        <?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
        <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="url" class="form-label">URL Imagine</label>
                <input type="text" name="url" class="form-control" required>
            </div>
            <button class="btn btn-primary">Salvează</button>
            <a href="index.php" class="btn btn-secondary">Înapoi</a>
        </form>
    </div>

<?php require_once '../bootstrap/footer.php'; ?>
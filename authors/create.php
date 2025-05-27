<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? null;
    $bio = $_POST['bio'] ?? null;

    if (!empty($name)) {
        try {
            $stmt = $conn->prepare("INSERT INTO Authors (name, email, bio) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $bio]);
            $message = "Autor adăugat!";
        } catch (PDOException $e) {
            $error = "Eroare: " . $e->getMessage();
        }
    } else {
        $error = "Numele este obligatoriu.";
    }
}

require_once '../bootstrap/header.php';
?>

<div class="container mt-4">
    <h1>Adaugă autor</h1>
    <?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nume</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email (opțional)</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="bio" class="form-label">Biografie</label>
            <textarea name="bio" class="form-control" rows="4"></textarea>
        </div>
        <button class="btn btn-primary">Salvează</button>
        <a href="index.php" class="btn btn-secondary">Înapoi</a>
    </form>
</div>

<?php require_once '../bootstrap/footer.php'; ?>

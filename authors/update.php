<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();

$id = $_GET['id'] ?? null;
$message = '';
$error = '';

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM Authors WHERE id = ?");
    $stmt->execute([$id]);
    $author = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $bio = $_POST['bio'] ?? '';

        if (!empty($name)) {
            $stmt = $conn->prepare("UPDATE Authors SET name = ?, email = ?, bio = ? WHERE id = ?");
            $stmt->execute([$name, $email, $bio, $id]);
            $message = "Autor actualizat!";
            $author['name'] = $name;
            $author['email'] = $email;
            $author['bio'] = $bio;
        } else {
            $error = "Numele este obligatoriu.";
        }
    }
}

require_once '../bootstrap/header.php';
?>

<div class="container mt-4">
    <h1>Editează autor</h1>
    <?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    <?php if ($author): ?>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nume</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($author['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($author['email']) ?>">
            </div>
            <div class="mb-3">
                <label for="bio" class="form-label">Biografie</label>
                <textarea name="bio" class="form-control" rows="4"><?= htmlspecialchars($author['bio']) ?></textarea>
            </div>
            <button class="btn btn-primary">Salvează</button>
            <a href="index.php" class="btn btn-secondary">Înapoi</a>
        </form>
    <?php endif; ?>
</div>

<?php require_once '../bootstrap/footer.php'; ?>

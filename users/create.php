<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? 'guest';

    if (!empty($name) && !empty($email)) {
        try {
            $stmt = $conn->prepare("INSERT INTO Users (name, email, role) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $role]);
            $message = "Utilizator adăugat!";
        } catch (PDOException $e) {
            $error = "Eroare: " . $e->getMessage();
        }
    } else {
        $error = "Toate câmpurile sunt obligatorii.";
    }
}

require_once '../bootstrap/header.php';
?>

<div class="container mt-4">
    <h1>Adaugă utilizator</h1>
    <?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nume</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Rol</label>
            <select name="role" class="form-select">
                <option value="admin">Admin</option>
                <option value="editor">Editor</option>
                <option value="guest" selected>Guest</option>
            </select>
        </div>
        <button class="btn btn-primary">Salvează</button>
        <a href="index.php" class="btn btn-secondary">Înapoi</a>
    </form>
</div>

<?php require_once '../bootstrap/footer.php'; ?>

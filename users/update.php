<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();

$id = $_GET['id'] ?? null;
$message = '';
$error = '';

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM Users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $role = $_POST['role'] ?? 'guest';

        if (!empty($name) && !empty($email)) {
            $stmt = $conn->prepare("UPDATE Users SET name = ?, email = ?, role = ? WHERE id = ?");
            $stmt->execute([$name, $email, $role, $id]);
            $message = "Utilizator actualizat!";
            $user['name'] = $name;
            $user['email'] = $email;
            $user['role'] = $role;
        } else {
            $error = "Toate câmpurile sunt obligatorii.";
        }
    }
}

require_once '../bootstrap/header.php';
?>

<div class="container mt-4">
    <h1>Editează utilizator</h1>
    <?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    <?php if ($user): ?>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nume</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="role" class="form-select">
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="editor" <?= $user['role'] === 'editor' ? 'selected' : '' ?>>Editor</option>
                    <option value="guest" <?= $user['role'] === 'guest' ? 'selected' : '' ?>>Guest</option>
                </select>
            </div>
            <button class="btn btn-primary">Salvează</button>
            <a href="index.php" class="btn btn-secondary">Înapoi</a>
        </form>
    <?php endif; ?>
</div>

<?php require_once '../bootstrap/footer.php'; ?>

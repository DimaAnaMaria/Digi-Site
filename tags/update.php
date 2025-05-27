<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();

$id = $_GET['id'] ?? null;
$message = '';
$error = '';

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM Tags WHERE id = ?");
    $stmt->execute([$id]);
    $tag = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $status = $_POST['status'] ?? 'public';

        if (!empty($name)) {
            try {
                $stmt = $conn->prepare("UPDATE Tags SET name = ?, status = ? WHERE id = ?");
                $stmt->execute([$name, $status, $id]);
                $message = "Tag actualizat!";
                $tag['name'] = $name;
                $tag['status'] = $status;
            } catch (PDOException $e) {
                $error = "Eroare: " . $e->getMessage();
            }
        } else {
            $error = "Numele tagului este obligatoriu.";
        }
    }
}

require_once '../bootstrap/header.php';
?>

<div class="container mt-4">
    <h1>Editează tag</h1>
    <?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    <?php if ($tag): ?>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nume tag</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($tag['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="public" <?= $tag['status'] === 'public' ? 'selected' : '' ?>>Public</option>
                    <option value="internal" <?= $tag['status'] === 'internal' ? 'selected' : '' ?>>Internal</option>
                </select>
            </div>
            <button class="btn btn-primary">Salvează</button>
            <a href="index.php" class="btn btn-secondary">Înapoi</a>
        </form>
    <?php endif; ?>
</div>

<?php require_once '../bootstrap/footer.php'; ?>

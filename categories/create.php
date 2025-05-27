<?php
require_once _DIR_ . '/../Database.php';

$conn = Database::getInstance()->getConnection();
$message = '';
$error = '';

// Preluăm toate categoriile pentru a putea selecta una ca părinte
$topCategories = $conn->query("SELECT id, name FROM Categories WHERE parent_id IS NULL")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $url = $_POST['url'] ?? null;
    $parent_id = $_POST['parent_id'] !== '' ? $_POST['parent_id'] : null;

    if (!empty($name)) {
        try {
            $stmt = $conn->prepare("INSERT INTO Categories (name, url, parent_id) VALUES (?, ?, ?)");
            $stmt->execute([$name, $url, $parent_id]);
            $message = "Categoria a fost adăugată cu succes.";
        } catch (PDOException $e) {
            $error = "Eroare la inserare: " . $e->getMessage();
        }
    } else {
        $error = "Numele categoriei este obligatoriu.";
    }
}

include '../bootstrap/header.php';
?>

<div class="container mt-4">
    <h2>Adaugă categorie nouă</h2>

    <?php if ($message): ?>
        <div class="alert alert-success"><?= $message ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nume categorie</label>
            <input type="text" name="name" class="form-control" required value="<?= $_POST['name'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input type="text" name="url" class="form-control" value="<?= $_POST['url'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label for="parent_id" class="form-label">Categorie părinte</label>
            <select name="parent_id" class="form-select">
                <option value="">Fără</option>
                <?php foreach ($topCategories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= (($_POST['parent_id'] ?? '') == $cat['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvează categoria</button>
        <a href="index.php" class="btn btn-secondary">Înapoi</a>
    </form>
</div>

<?php include '../bootstrap/footer.php'; ?>


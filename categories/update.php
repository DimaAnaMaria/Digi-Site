<?php
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_WARNING);
require_once _DIR_ . '/../Database.php';

$conn = Database::getInstance()->getConnection();

$category = null;
$message = '';
$error = '';

// Obținem ID-ul categoriei din URL
$id = $_GET['id'] ?? null;

if ($id) {
    // Preluăm categoria curentă
    $stmt = $conn->prepare("SELECT * FROM Categories WHERE id = ?");
    $stmt->execute([$id]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    // Preluăm toate categoriile părinte (fără categoria curentă)
    $parentOptions = $conn->prepare("SELECT id, name FROM Categories WHERE parent_id IS NULL AND id != ?");
    $parentOptions->execute([$id]);
    $topCategories = $parentOptions->fetchAll(PDO::FETCH_ASSOC);

    // Procesăm formularul
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $url = $_POST['url'] ?? null;
        $parent_id = $_POST['parent_id'] !== '' ? $_POST['parent_id'] : null;

        if (!empty($name)) {
            try {
                $stmt = $conn->prepare("UPDATE Categories SET name = ?, url = ?, parent_id = ? WHERE id = ?");
                $stmt->execute([$name, $url, $parent_id, $id]);
                $message = "Categoria a fost actualizată cu succes.";

                // Reîncărcăm categoria actualizată
                $stmt = $conn->prepare("SELECT * FROM Categories WHERE id = ?");
                $stmt->execute([$id]);
                $category = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                $error = "Eroare la actualizare: " . $e->getMessage();
            }
        } else {
            $error = "Numele este obligatoriu.";
        }
    }
}

require_once '../bootstrap/header.php';
?>

<section>
    <div class="container mt-4">
        <h1>Editează categoria</h1>

        <?php if ($message): ?>
            <div class="alert alert-success"><?= $message ?></div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($category): ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Nume</label>
                    <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($category['name']) ?>">
                </div>

                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <input type="text" name="url" class="form-control" value="<?= htmlspecialchars($category['url']) ?>">
                </div>

                <div class="mb-3">
                    <label for="parent_id" class="form-label">Categorie părinte</label>
                    <select name="parent_id" class="form-select">
                        <option value="">Fără</option>
                        <?php foreach ($topCategories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $category['parent_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Salvează modificările</button>
                <a href="index.php" class="btn btn-secondary">Înapoi</a>
            </form>
        <?php else: ?>
            <div class="alert alert-warning">Categoria nu a fost găsită.</div>
            <a href="index.php" class="btn btn-secondary">Înapoi</a>
        <?php endif; ?>
    </div>
</section>

<?php require_once '../bootstrap/footer.php'; ?>



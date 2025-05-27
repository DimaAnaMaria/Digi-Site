<?php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../ArticleModel.php';

$ArticleModel = new ArticleModel();
$article = null;
$message = '';
$error = '';

// Preluare articol
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $article = $ArticleModel->get($id);
    if (!$article) {
        $error = "Articolul nu a fost găsit.";
    }
}

// Confirmare ștergere
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $deleted = $ArticleModel->delete($id);

    if ($deleted) {
        header("Location: index.php?deleted=1");
        exit;
    } else {
        $error = "Eroare la ștergere.";
    }
}

require_once '../bootstrap/header.php';
?>

    <div class="container mt-4">
        <h2>Confirmare ștergere articol</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php elseif ($article): ?>
            <div class="alert alert-warning">
                <p>Ești sigur că vrei să ștergi articolul:</p>
                <ul>
                    <li><strong>Titlu:</strong> <?= htmlspecialchars($article['title']) ?></li>
                    <li><strong>Status:</strong> <?= htmlspecialchars($article['status']) ?></li>
                    <li><strong>Autor:</strong> <?= htmlspecialchars($article['author_name']) ?></li>
                </ul>
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                    <button type="submit" class="btn btn-danger">Da, șterge</button>
                    <a href="index.php" class="btn btn-secondary">Anulează</a>
                </form>
            </div>
        <?php endif; ?>
    </div>

<?php require_once '../bootstrap/footer.php'; ?>
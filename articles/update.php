<?php
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_WARNING);
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../ArticleModel.php';

$ArticleModel = new ArticleModel();
$conn = Database::getInstance()->getConnection();

$message = '';
$error = '';
$id = $_GET['id'] ?? null;

$article = null;
$authors = $conn->query("SELECT id, name FROM Users")->fetchAll(PDO::FETCH_ASSOC);

if ($id) {
    $article = $ArticleModel->get($id);

    if (!$article) {
        $error = "Articolul nu a fost găsit.";
    }

    // Actualizare articol
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'content' => $_POST['content'] ?? '',
            'author_id' => $_POST['author_id'] ?? null,
            'status' => $_POST['status'] ?? 'draft',
            'published_at' => $_POST['published_at'] ?? null,
        ];

        if ($ArticleModel->update($id, $data)) {
            $message = "Articolul a fost actualizat cu succes!";
            $article = $ArticleModel->get($id); // Reîncarcă articolul actualizat
        } else {
            $error = "Eroare la actualizarea articolului.";
        }
    }
}

require_once '../bootstrap/header.php';
?>

    <section>
        <div class="container mt-4">
            <h1>Editează articolul</h1>

            <?php if ($message): ?>
                <div class="alert alert-success"><?= $message ?></div>
            <?php elseif ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <?php if ($article): ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Titlu</label>
                        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($article['title']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descriere</label>
                        <textarea name="description" class="form-control" rows="2"><?= htmlspecialchars($article['description']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Conținut</label>
                        <textarea name="content" class="form-control" rows="6"><?= htmlspecialchars($article['content']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="author_id" class="form-label">Autor</label>
                        <select name="author_id" class="form-select" required>
                            <option value="">Selectează autor</option>
                            <?php foreach ($authors as $author): ?>
                                <option value="<?= $author['id'] ?>" <?= $author['id'] == $article['author_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($author['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="draft" <?= $article['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
                            <option value="public" <?= $article['status'] === 'public' ? 'selected' : '' ?>>Public</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="published_at" class="form-label">Data publicării</label>
                        <input type="datetime-local" name="published_at" class="form-control"
                               value="<?= date('Y-m-d\TH:i', strtotime($article['published_at'] ?? date('Y-m-d H:i'))) ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Salvează</button>
                    <a href="index.php" class="btn btn-secondary">Înapoi</a>
                </form>
            <?php endif; ?>
        </div>
    </section>

<?php
require_once '../bootstrap/footer.php';
?>


    </div>
    </section>

<?php
require_once '../bootstrap/footer.php';  // Include scripturile și închiderea HTML
?>
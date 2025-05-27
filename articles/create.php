<?php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../ArticleModel.php';

$conn = Database::getInstance()->getConnection();
$ArticleModel = new ArticleModel();

$message = '';
$error = '';
$authors = $conn->query("SELECT id, name FROM Users")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'title' => $_POST['title'] ?? '',
        'description' => $_POST['description'] ?? '',
        'content' => $_POST['content'] ?? '',
        'author_id' => $_POST['author_id'] ?? null,
        'status' => $_POST['status'] ?? 'draft',
        'published_at' => $_POST['published_at'] ?? null
    ];

    if ($ArticleModel->create($data)) {
        $message = "Articol adăugat cu succes!";
    } else {
        $error = "Eroare la salvarea articolului.";
    }
}

include '../bootstrap/header.php';
?>

    <div class="container mt-4">
        <h2>Adaugă articol nou</h2>

        <?php if ($message): ?>
            <div class="alert alert-success"><?= $message ?></div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Titlu</label>
                <input type="text" name="title" class="form-control" value="Cod galben de ploi și vijelii în mai multe județe" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descriere</label>
                <textarea name="description" class="form-control" rows="2">Meteorologii au emis un cod galben de instabilitate atmosferică accentuată în mai multe zone ale țării.</textarea>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Conținut</label>
                <textarea name="content" class="form-control" rows="6">Potrivit ANM, începând de miercuri după-amiază și până joi dimineață sunt așteptate averse torențiale, descărcări electrice, intensificări ale vântului și grindină în mai multe județe din vestul, centrul și nordul țării.</textarea>
            </div>

            <div class="mb-3">
                <label for="author_id" class="form-label">Autor</label>
                <select name="author_id" class="form-select" required>
                    <option value="">Selectează autor</option>
                    <?php foreach ($authors as $author): ?>
                        <option value="<?= $author['id'] ?>"><?= htmlspecialchars($author['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="draft">Draft</option>
                    <option value="public">Public</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="published_at" class="form-label">Data publicării</label>
                <input type="datetime-local" name="published_at" class="form-control"
                       value="<?= date('Y-m-d\TH:i') ?>">
            </div>

            <button type="submit" class="btn btn-primary">Publică articolul</button>
            <a href="index.php" class="btn btn-secondary">Înapoi</a>
        </form>
    </div>

<?php include '../bootstrap/footer.php'; ?>
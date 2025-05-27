<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();
$images = $conn->query("SELECT * FROM Images ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
require_once '../bootstrap/header.php';
?>

    <div class="container mt-4">
        <h1>Listare imagini</h1>
        <a href="create.php" class="btn btn-success mb-3">Adaugă imagine</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>URL</th>
                <th>Previzualizare</th>
                <th>Opțiuni</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($images as $img): ?>
                <tr>
                    <td><?= $img['id'] ?></td>
                    <td><?= htmlspecialchars($img['url']) ?></td>
                    <td><img src="<?= $img['url'] ?>" alt="Image" width="100"></td>
                    <td>
                        <a href="read.php?id=<?= $img['id'] ?>">View</a> |
                        <a href="delete.php?id=<?= $img['id'] ?>" onclick="return confirm('Ești sigur?')">Șterge</a> |
                        <a href="update.php?id=<?= $img['id'] ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php require_once '../bootstrap/footer.php'; ?>
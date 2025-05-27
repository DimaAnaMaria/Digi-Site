<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();
$authors = $conn->query("SELECT * FROM Authors ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
require_once '../bootstrap/header.php';
?>

<div class="container mt-4">
    <h1>Listare autori</h1>
    <a href="create.php" class="btn btn-success mb-3">Adaugă autor</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nume</th>
            <th>Email</th>
            <th>Opțiuni</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($authors as $author): ?>
            <tr>
                <td><?= $author['id'] ?></td>
                <td><?= htmlspecialchars($author['name']) ?></td>
                <td><?= htmlspecialchars($author['email']) ?></td>
                <td>
                    <a href="read.php?id=<?= $author['id'] ?>">View</a> |
                    <a href="update.php?id=<?= $author['id'] ?>">Edit</a> |
                    <a href="delete.php?id=<?= $author['id'] ?>" onclick="return confirm('Ești sigur?')">Șterge</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../bootstrap/footer.php'; ?>

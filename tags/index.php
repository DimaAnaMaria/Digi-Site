<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();
$tags = $conn->query("SELECT * FROM Tags ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
require_once '../bootstrap/header.php';
?>

<div class="container mt-4">
    <h1>Listare taguri</h1>
    <a href="create.php" class="btn btn-success mb-3">Adaugă tag</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nume</th>
            <th>Status</th>
            <th>Opțiuni</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tags as $tag): ?>
            <tr>
                <td><?= $tag['id'] ?></td>
                <td><?= htmlspecialchars($tag['name']) ?></td>
                <td><?= htmlspecialchars($tag['status']) ?></td>
                <td>
                    <a href="read.php?id=<?= $tag['id'] ?>">View</a> |
                    <a href="update.php?id=<?= $tag['id'] ?>">Edit</a> |
                    <a href="delete.php?id=<?= $tag['id'] ?>" onclick="return confirm('Ești sigur că vrei să ștergi acest tag?')">Șterge</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../bootstrap/footer.php'; ?>

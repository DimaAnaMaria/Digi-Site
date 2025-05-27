<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();
$categories = $conn->query("SELECT * FROM Categories ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
require_once '../bootstrap/header.php';
?>

<div class="container mt-4">
    <h1>Listare categorii</h1>
    <a href="create.php" class="btn btn-success mb-3">Adaugă categorie</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nume</th>
            <th>URL</th>
            <th>Părinte</th>
            <th>Opțiuni</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $cat): ?>
            <tr>
                <td><?= $cat['id'] ?></td>
                <td><?= htmlspecialchars($cat['name']) ?></td>
                <td><?= htmlspecialchars($cat['url']) ?></td>
                <td><?= $cat['parent_id'] ?? '—' ?></td>
                <td>
                    <a href="read.php?id=<?= $cat['id'] ?>">View</a> |
                    <a href="delete.php?id=<?= $cat['id'] ?>" onclick="return confirm('Ești sigur că vrei să ștergi?')">Șterge</a> |
                    <a href="update.php?id=<?= $cat['id'] ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../bootstrap/footer.php'; ?>


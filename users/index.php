<?php
require_once '../Database.php';
$conn = Database::getInstance()->getConnection();
$users = $conn->query("SELECT * FROM Users ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
require_once '../bootstrap/header.php';
?>

<div class="container mt-4">
    <h1>Listare utilizatori</h1>
    <a href="create.php" class="btn btn-success mb-3">Adaugă utilizator</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nume</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Opțiuni</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
                <td>
                    <a href="read.php?id=<?= $user['id'] ?>">View</a> |
                    <a href="update.php?id=<?= $user['id'] ?>">Edit</a> |
                    <a href="delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Ești sigur că vrei să ștergi acest utilizator?')">Șterge</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../bootstrap/footer.php'; ?>

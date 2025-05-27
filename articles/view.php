<?php
ini_set('display_errors', 1);
error_reporting(E_ALL ^E_WARNING);
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../ArticleModel.php';

$ArticleModel = new ArticleModel();
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$Article=$ArticleModel->get($id);

require_once '../bootstrap/header.php';  // Include navbarul și head-ul
?>
<section>
    <div class="container mt-4">
        <h1>View</h1>




    </div>
</section>

<?php
require_once '../bootstrap/footer.php';  // Include scripturile și închiderea HTML
?>


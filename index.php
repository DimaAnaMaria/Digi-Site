<?php
ini_set('display_errors', 1);
error_reporting(E_ALL ^E_WARNING);
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/ArticleModel.php';

$ArticleModel = new ArticleModel();
$Articles=$ArticleModel->get();
//echo "<pre>";
//print_r($Articles);
//echo "</pre>";

require_once 'bootstrap/header.php';  // Include navbarul și head-ul
?>

<div class="container mt-4">
    <h1>Welcome!</h1>
    <p>This is the main page of Digi.</p>
</div>

<?php
require_once 'bootstrap/footer.php';  // Include scripturile și închiderea HTML

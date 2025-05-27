<?php
ini_set('display_errors', 1);
error_reporting(E_ALL ^E_WARNING);
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../ArticleModel.php';

$ArticleModel = new ArticleModel();
$Articles=$ArticleModel->get();
////echo "<pre>";
////print_r($Articles);
////echo "</pre>";


require_once '../bootstrap/header.php';  // Include navbarul și head-ul
?>
<section>
    <div class="container mt-4">
        <h1>Listare articole</h1>


        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Published</th>
                <th scope="col">Optiuni</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($Articles as $article) { ?>
                <tr>
                    <th scope="row"><?php echo $article['id']?></th>
                    <td><?php echo $article['title']?></td>
                    <td><?php echo $article['created_at']?></td>
                    <td>
                        <a href="http://localhost/articles/view.php?id=<?php echo $article['id']?>">View</a>
                        | <a href="http://localhost/articles/delete.php?id=<?php echo $article['id']?>">Sterge</a> |
                        <a href="http://localhost/articles/update.php?id=<?php echo $article['id']?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>



    </div>
</section>

<?php
require_once '../bootstrap/footer.php';  // Include scripturile și închiderea HTML
?>



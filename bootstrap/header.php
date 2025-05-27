<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg fixed-top">  <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="#">Digi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://localhost/articles/" role="button" data-bs-toggle="dropdown">Articles</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="http://localhost/articles/index.php">List</a></li>
                        <li><a class="dropdown-item" href="http://localhost/articles/create.php">New article</a></li>
                    </ul>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://localhost/categories/" role="button" data-bs-toggle="dropdown">Categories</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="http://localhost/categories/index.php">List</a></li>
                        <li><a class="dropdown-item" href="http://localhost/categories/create.php">New Category</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://localhost/authors/" role="button" data-bs-toggle="dropdown">Authors</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="http://localhost/authors/index.php">List</a></li>
                        <li><a class="dropdown-item" href="http://localhost/authors/create.php">New Author</a></li>
                    </ul>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://localhost/images/" role="button" data-bs-toggle="dropdown">Images</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="http://localhost/images/index.php">List</a></li>
                        <li><a class="dropdown-item" href="http://localhost/images/create.php">New Image</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://localhost/tags/" role="button" data-bs-toggle="dropdown">Tags</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="http://localhost/tags/index.php">List</a></li>
                        <li><a class="dropdown-item" href="http://localhost/tags/create.php">New Tag</a></li>
                    </ul>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://localhost/users/" role="button" data-bs-toggle="dropdown">Users</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="http://localhost/users/index.php">List</a></li>
                        <li><a class="dropdown-item" href="http://localhost/users/create.php">New User</a></li>
                    </ul>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://localhost/articleTags/"  role="button" data-bs-toggle="dropdown">ArticleTags</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="http://localhost/articleTags/create.php">New ArticleTag</a></li>
                        <li><a class="dropdown-item" href="http://localhost/articleTags/read.php">Read</a></li>
                        <li><a class="dropdown-item" href="http://localhost/articleTags/update.php">Edit</a></li>
                        <li><a class="dropdown-item" href="http://localhost/articleTags/delete.php">Delete</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://localhost/articleCtegories/"  role="button" data-bs-toggle="dropdown">ArticleCategories</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="http://localhost/articleCategories/create.php">New ArticleCategory</a></li>
                        <li><a class="dropdown-item" href="http://localhost/articleCategories/read.php">Read</a></li>
                        <li><a class="dropdown-item" href="http://localhost/articleCategories/update.php">Edit</a></li>
                        <li><a class="dropdown-item" href="http://localhost/articleCategories/delete.php">Delete</a></li>
                    </ul>
                </li>
            </ul>

            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
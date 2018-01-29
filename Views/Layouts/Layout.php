<?php
use \Controllers\AdminController as AdminController;
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Task Tracker</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="/public/css/style_layout.css" rel="stylesheet" type="text/css">
        <link href="/public/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">


        <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"  crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"  crossorigin="anonymous"></script>

        <script src="/public/js/function.js"></script>
    <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Task Tracker</a>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Tasks <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/site/addtaskpage">Add Task</a>
                </li>

            </ul>
            <?php if(!AdminController::checkAdmin()){?>
                <a class="nav-link" href="/admin/">Login As Admin</a>
            <?php } else {?>
                <a class="nav-link" href="/admin/">Logoff</a>
            <?php }?>

        </div>
    </nav>
        <main role="main" class="container">
            <div class="starter-template">
                <?= $body ?>
            </div>
        </main>
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Ajout de la balise meta avec name et content -->
    <meta name="csrf-token" content=<?= App\Session::getTokenCSRF() ?>> 
    <title>FORUM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/minty/bootstrap.min.css" integrity="sha384-H4X+4tKc7b8s4GoMrylmy2ssQYpDHoqzPa9aKXbDwPoPUA3Ra8PA5dGzijN+ePnH" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>

    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">

        <svg class="bi me-2" width="40" height="32">
            <use xlink:href="#bootstrap" />
        </svg>
        <a href="index.php?ctrl=home&action=index" class="navbar-brand">My Forum</a>
        <?php

        use App\Session;

        if(App\Session::isAdmin()){ ?>
            <a href="index.php?ctrl=home&action=users">Voir la liste des gens</a><?php
        } ?>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="index.php?ctrl=home&action=index" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="index.php?ctrl=forum&action=listCategories" class="nav-link">Categories</a></li>
            <li class="nav-item"><a href="index.php?ctrl=forum&action=listTopics" class="nav-link">Topics</a></li>
            <li class="nav-item"><a href="index.php?ctrl=forum&action=listUsers" class="nav-link">User</a></li>
        </ul>

        <div class="col-md-3 text-end">
            <?php 
            if(App\Session::getUser()) { ?>
                <a href="index.php?ctrl=security&action=logout" class="btn btn-secondary">Déconnexion</a><?php
            } 
            else { ?>
                <a href="index.php?ctrl=security&action=login" class="btn btn-outline-secondary">Login</a>
                <a href="index.php?ctrl=security&action=registerForm" class="btn btn-secondary">Sign-up</a><?php
            } ?>
        </div>

    </header>

    <div id="wrapper">
        <main class="px-3" id="forum">
            
                <div class="alert alert-dismissible alert-info">
                    <p class="mb-0"><?= App\Session::getFlash("success") ?></p>
                    <p class="mb-0"><?= App\Session::getFlash("error") ?></p>
                    <input type="button" class="btn-close" data-bs-dismiss="alert">
                </div>
            

            <?= $page ?>

        </main>
    </div>

    <footer>
        <p class="text-center">&copy; 2022 - Manivone PH</p>
    </footer>

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>
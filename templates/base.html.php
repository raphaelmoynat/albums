<?php

use Core\Session\Flash;
use Core\Session\Session;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Framework php</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <?php if (!Session::userConnected()): ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?type=security&action=register">Sign Up</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?type=security&action=signin">Sign In</a>
                    </li>
                <?php endif; ?>

                <?php if (Session::userConnected()): ?>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?type=security&action=signOut">Sign Out</a>
                    </li>
                <?php endif; ?>

                <?php if (Session::userConnected()): ?>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?type=album&action=create">Ajouter un album</a>
                    </li>
                <?php endif; ?>



            </ul>

        </div>
    </div>
</nav>

<div class="container mt-3">
    <?php foreach (Flash::getFlashes() as $flash) : ?>
        <div class="alert alert-<?= $flash['color'] ?> alert-dismissible fade show" role="alert">
            <?= $flash['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php  endforeach; ?>
</div>
<div class="container mt-3">

    <?= $content ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="description" content="bonus">
    <meta name="author" content="Laura Kabáthová">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/accordion.css" rel="stylesheet">
    <title>Stranka</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg fixed-top bg-dark mb-4" data-bs-theme="light">
        <div class="container-fluid text-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarcollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-uppercase" id="navbarcollapse">
                <div class="navbar-nav mx-auto">
                    <a class="nav-link text-white" href="index.php">Domov</a>
                    <a class="nav-link text-white" href="Qna.php">QNA</a>
                    <a class="nav-link text-white" href="kontakt.php">Kontakt</a>
                    <?php
                    if (!(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)){
                        echo '<a class="nav-link text-white" href="login.php">Login</a>';
                    }?>

                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
                    echo '<a class="nav-link text-white" href="logout.php">Logout</a>';
                    }?>
                </div>
            </div>
        </div>
    </nav>
</header>





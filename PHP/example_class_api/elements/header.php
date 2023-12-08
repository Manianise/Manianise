<?php 
  if(session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once 'functions.php'; 
require_once 'functions/auth.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title><?php if (isset($title)) { echo $title;} else {echo 'Mon Site';} ?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-static/">

    

    

    <link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">
  </head>

  <body>
    
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">

<div class="container-fluid">
  <a href="index.php" class="nav-link nav"> Mon Site</a>

  <ul class="navbar-nav">
      <li><?= nav_menu('nav-link') ?></li>
    </ul>

    <ul class="navbar-nav">
    <?php if(est_connecte()) : ?>
      <li><a href="/logout.php" class="nav-link"> Se déconnecter</a></li>
    <?php endif ?>
    </ul>
</div>


</nav>
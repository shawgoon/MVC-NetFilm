<?php
session_start();
// var_dump($_SERVER);
require_once("../Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
// $routeController->getRoute("index");


// require_once("../inc/pdo.php");
// require_once("../Controller/FilmController.php");

// $film = (FilmController::getFilmById(4238,$instance));
// var_dump($film)/*  $film->getTitle() */;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assets/js/master.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <?php /* include($routeController->getRoute("menu")); */ include('./menu.php'); ?>
    </header>
    <main>
        <ul id="list"></ul>
    </main>
    <footer></footer>
</body>
</html>
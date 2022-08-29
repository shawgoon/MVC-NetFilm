<?php
session_start();
// var_dump($_SERVER);
require_once("../Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once("../Controller/FilmController.php");
// $filmController = new FilmController();
$films = FilmController::showMovies(10);
// var_dump($films);
$films = json_encode($films);

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/7.18.13/babel.min.js" integrity="sha512-PRl9KbPVEMeO1HV3BU5hcxpipzo2EVLe+tvWfLJf0A7PnKCfShArjZ2iXVAVo8ffpBSfRO0K58TYuquQvVSeVA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <script>const films = <?= $films ?>; /* console.dir(films); */</script>
    <script src="../assets/js/master.js" defer></script>
    <script src="../assets/js/card.js" type="text/babel" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <?php /* include($routeController->getRoute("menu")); */ include('./menu.php'); ?>
    </header>
    <main>
        <?php /* $result = $films->showMovies(10); */ ?>
        <section id="cardsFrame">
            <?php
            // foreach($result as $film){
            //     $images = "../assets/img/posters/".$film['id_movie'];
            //     // var_dump($images);
            //     echo (' 
            //     <div class="card">
            //         <div class="imgCard">
            //             <img src="'.$images.'"alt="">
            //         </div>
            //         <div class="infos">
            //             <h3>Titre : '.$film["title"].'</h3>
            //             <p>Description : '.$film["plot"].'</p>
            //             <p>Réalisateur : '.$film["directors"].'</p>
            //             <p>Avec : '.$film["cast"].'</p>
            //             <p>Genre : '.$film["genres"].'</p>
            //             <p>Année : '.$film["year"].'</p>
            //         </div>
            //     </div>
            //     '); 
            // }
            ?>
        </section>
    </main>
    <footer></footer>
</body>
</html>
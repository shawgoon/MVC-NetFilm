<?php
session_start();
if($_SERVER['PHP_SELF'] === '/NetFilm/index.php'){
    $pref = './';
} else {
    $pref = '../';
}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once ($routeController->getController("FilmController"));

if(isset($_GET["id_movie"]) && !empty($_GET["id_movie"])){
    $singleFilm = FilmController::getFilmByid(strip_tags($_GET["id_movie"]));
} else {
    header("Location:".$routeController->getRoute("index"));
    die;
}
// var_dump($singleFilm);
$url = $routeController->getRoute("singleFilm");
$xhrUrl = $routeController->getRoute("addPref");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre choix de Film</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/7.18.13/babel.min.js" integrity="sha512-PRl9KbPVEMeO1HV3BU5hcxpipzo2EVLe+tvWfLJf0A7PnKCfShArjZ2iXVAVo8ffpBSfRO0K58TYuquQvVSeVA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <script>
        const films = <?= $singleFilm ?>; /* console.dir(films); */
        const dCard = false;
        const url = "<?= $url ?>";
        const xhrUrl = "<?= $xhrUrl ?>";
    </script>
    <script src="<?= $routeController->getAssets(); ?>js/card.js" type="text/babel" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= $routeController->getAssets(); ?>css/style.css">
    <link rel="stylesheet" href="<?= $routeController->getAssets(); ?>css/search.css">
    <link rel="stylesheet" href="<?= $routeController->getAssets(); ?>css/singleCard.css">
</head>
<body>
    <header>
    <?php include($routeController->getInc("menu")); ?>
    </header>
    <main>
        <section id="cardsFrame"></section>
    </main>

        
</body>
</html>
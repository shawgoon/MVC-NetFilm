<?php
session_start();
// var_dump($_SERVER);
if($_SERVER['PHP_SELF'] === '/NetFilm/index.php'){
    $pref = './';
} else {
    $pref = '../';
}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once ($routeController->getController("FilmController"));
$pages = FilmController::getPage($_GET['genre']);
$activPrec = false;
$activPage = 1;
$activSuiv = false;
$currentPage = 1;

// var_dump($pages);
// On détermine sur quelle page on se trouve
if(isset($_GET['currentPage']) && !empty($_GET['currentPage'])){
    $reponsePageManager = FilmController::pageManager($_GET['currentPage'],$pages,$activPrec,$activPage,$activSuiv);
    $activPrec = $reponsePageManager[0];
    $activPage = $reponsePageManager[1];
    $avitvSuiv = $reponsePageManager[2];
    $currentPage = $reponsePageManager[3];
} else {
    $activPrec = true;
}

$genreFilms = FilmController::showGenre($_GET['genre'],$currentPage);
$genreFilms = json_encode($genreFilms);
$url = $routeController->getRoute("singleFilm");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégorie</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/7.18.13/babel.min.js" integrity="sha512-PRl9KbPVEMeO1HV3BU5hcxpipzo2EVLe+tvWfLJf0A7PnKCfShArjZ2iXVAVo8ffpBSfRO0K58TYuquQvVSeVA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <script>
        const films = <?= $genreFilms ?>; /* console.dir(films); */
        const dCard = true;
        const url = "<?= $url ?>";
    </script>
    <script src="<?= $routeController->getAssets(); ?>js/card.js" type="text/babel" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= $routeController->getAssets(); ?>css/style.css">
    <link rel="stylesheet" href="<?= $routeController->getAssets(); ?>css/search.css">
</head>
<body>
    <header>
    <?php include($routeController->getInc("menu")); ?>
    </header>
    <main>
        <h4 class="titleCat"><?= $_GET['genre']; ?></h4> 
        <?php include($routeController->getInc("pagination")); ?>
        <section id="cardsFrame"></section>
        <section id="pagination">
           <?php include($routeController->getInc("pagination")); ?>

        </section>
    </main>
</body>
</html>
<?php
// if($_SERVER['PHP_SELF'] === '/NetFilm/index.php'){
//     $pref = './';
// } else {
//     $pref = '../';
// }
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);

require_once ($routeController->getController("SessionController"));
$activSession = SessionController::activSession();
require_once ($routeController->getController("FilmController"));
$genres = FilmController::menuGenre();
?>
<link rel="stylesheet" href="<?= $routeController->getAssets()?>css/search.css">
<script src="<?= $routeController->getAssets()?>js/search.js" defer></script>
<nav>
    <ul class="navHead">
        <div class="logo"><li><a href="<?= $routeController->getRoute("index"); ?>">NetFilm <i class="fa-solid fa-film"></i></a></li></div>
        <?php if (!$activSession) { ?>
            <div class="user">
                <li class="button"><a href="<?= $routeController->getRoute("registForm"); ?>">S'enregistrer</a></li>
                <li class="button"><a href="<?= $routeController->getRoute("connectForm"); ?>">Se connecter</a></li>

            </div>
        <?php } else { ?>
            <div class="listFilm"><li><a href="<?= $routeController->getRoute("film"); ?>">Films</a></li></div>
            
            <select href="#" class="listCat" role="button" onChange="location = this.options[this.selectedIndex].value;">
                    <option class="listCat" >
                        Genres
                    </option>
                <?php foreach ($genres as $key => $value){ ?>
                    <option class="listCat" onclick="$_GET['genre']" value="<?= $routeController->getRoute("category"); ?>?genre=<?= $value["genre"] ?>">
                        <?= $value["genre"] ?>
                    </option>
               <?php } ?>
            </select>
            <div class="search">
                <div action="" id="formAuto">
                    <input class="" type="text" placeholder="search">
                    <button id="searchBtn" data-xhrurl="<?= $routeController->getRoute("singleFilm") ?>"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <ul id="list" data-xhrurl="<?=$routeController->getInc("search")?>"></ul>
            </div>
            <div class="user">
                <li class="info">Bonjour, <?= $_SESSION["user"]["pseudo"] ?></li>
                <li class="button"><a href="<?= $routeController->getRoute("logout"); ?>">Déconnexion</a></li>
            </div>
        <?php } ?>
    </ul>
</nav>
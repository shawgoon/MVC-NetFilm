<?php
require_once ($routeController->getController("SessionController"));
$activSession = SessionController::activSession();

?>
<nav>
    <ul class="navHead">
        <div class="logo"><li><a href="<?= $routeController->getRoute("index"); ?>">NetFilm <i class="fa-solid fa-film"></i></a></li></div>
        <?php if (!$activSession) { ?>
            <div class="user">
                <li class="button"><a href="<?= $routeController->getRoute("registForm"); ?>">S'enregistrer</a></li>
                <li class="button"><a href="<?= $routeController->getRoute("connectForm"); ?>">Se connecter</a></li>

            </div>
        <?php } else { ?>
            <div class="list"><li><a href="<?= $routeController->getRoute("film"); ?>">Films</a></li></div>
            <div class="user">
                <li class="info">Bonjour, <?= $_SESSION["user"]["pseudo"] ?></li>
                <li class="button"><a href="<?= $routeController->getRoute("logout"); ?>">Déconnexion</a></li>

            </div>
        <?php } ?>
    </ul>
</nav>
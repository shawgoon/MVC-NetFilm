<?php 
    session_start();
    // On supprime la session, ce qui va déconnecter l'utilisateur.
    session_destroy();
    if($_SERVER['PHP_SELF'] === '/NetFilm/index.php'){
        $pref = './';
    } else {
        $pref = '../';
    }
    require_once($pref."Controller/RouteController.php");
    $routeController = new RouteController($_SERVER);
    
    header('Location:'.$routeController->getRoute("index")); // renseigner la bonne adresse d'hébergeur( localhost)
    exit();
?>
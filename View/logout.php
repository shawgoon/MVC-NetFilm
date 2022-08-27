<?php 
    session_start();
    // On supprime la session, ce qui va déconnecter l'utilisateur.
    session_destroy();
    require_once("../Controller/RouteController.php");
    $routeController = new RouteController($_SERVER);
    
    header('Location:'.$routeController->getRoute("index")); // renseigner la bonne adresse d'hébergeur( localhost)
    exit();
?>
<?php
session_start();
require_once("../Controller/UserController.php");
$userController = new UserController();
require_once("../Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
$login = $userController->login($_POST,$_SESSION);
// var_dump($userController->errors);
// var_dump($userController->post);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulaire de connexion</title>
</head>
<body>
    <header>
    <a href="<?=$routeController->getRoute("index")?>">Retour à l'index</a>
    <?php /* include ($routeController->getRoute("menu")); */ /* include('../menu.php'); */?>
    </header>

    <section class="formLogin">
        <form action="" method="post" enctype="multipart/form-data">
            <br>
            <label for="">Email ou pseudo</label><br>
            <input type="text" name="email" value="<?= isset($userController->post["email"])?$userController->post["email"]:""  ?>">
            <?= isset($userController->errors["email"])?'<span>'.$userController->errors["email"].'</span>':"" ?>
            <br>
            <label for="">Mot de passe</label><br>
            <input type="password" name="pwd" value="<?= isset($userController->post["pwd"])?$userController->post["pwd"]:""  ?>">
            <?= isset($userController->errors["pwd"])?'<span>'.$userController->errors["pwd"].'</span>':"" ?>      
            <br><br>
            <input type="submit" name="send" value="Envoyer">
        </form>
    </section>
</body>
</html>
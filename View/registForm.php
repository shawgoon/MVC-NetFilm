<?php 
session_start();
require_once("../Controller/UserController.php");
$userController = new UserController();
require_once("../Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
$register = $userController->register($_POST);
// var_dump($userController->errors);
// var_dump($userController->post);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulaire d'inscription</title>
</head>
<body>
    <header>
    <a href="<?=$routeController->getRoute("index")?>">Retour à l'index</a>
        <?php /* include ($routeController->getRoute("menu")); */ /* include('./menu.php'); */?> 
    </header>
    <section class="formSignup">
        <form action="" method="post" enctype="multipart/form-data">
            <br>
            <label for="">Pseudo</label><br>
            <input type="text" name="pseudo" value="<?= isset($userController->post["pseudo"])?$userController->post["pseudo"]:""  ?>">
            <?= isset($userController->errors["pseudo"])?'<span>'.$userController->errors["pseudo"].'</span>':"" ?>
            <br>
            <label for="">Email</label><br>
            <input type="email" name="email" value="<?= isset($userController->post["email"])?$userController->post["email"]:""  ?>">
            <?= isset($userController->errors["email"])?'<span>'.$userController->errors["email"].'</span>':"" ?>
            <br>
            <label for="">Mot de passe</label><br>
            <input type="password" name="pwd" value="<?= isset($userController->post["pwd"])?$userController->post["pwd"]:""  ?>">
            <?= isset($userController->errors["pwd"])?'<span>'.$userController->errors["pwd"].'</span>':"" ?>
            <br>
            <label for="">Confirme mot de passe</label><br>
            <input type="password" name="confirmPwd" value="<?= isset($userController->post["confirmPwd"])?$userController->post["confirmPwd"]:""  ?>">
            <?= isset($userController->errors["confirmPwd"])?'<span>'.$userController->errors["confirmPwd"].'</span>':"" ?>
            <br><br>
            <input type="submit" name="send" value="Envoyer">
        </form>
    </section>
</body>
</html>
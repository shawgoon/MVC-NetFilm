<?php
class SessionController {
    // private $session;

    public static function newSession($session, $userData){
        // var_dump($_SESSION);
        $_SESSION["user"]['id_user'] = $userData['id_user'];
        $_SESSION["user"]["email"] = $userData["email"];
        $_SESSION["user"]["pseudo"] = $userData["pseudo"];
        $_SESSION["user"]["pref"] = $userData["pref"];
        $_SESSION["user"]["role"] = $userData["role"];
    }
    public static function activSession(){
        if (isset($_SESSION["user"])){
            return true;
        } else {
            return false;
        }
    }
}
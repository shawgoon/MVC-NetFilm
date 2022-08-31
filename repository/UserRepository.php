<?php
if($_SERVER['PHP_SELF'] === '/NetFilm/index.php'){
    $pref = './';
} else {
    $pref = '../';
}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);

require_once($pref."inc/connectBDD.php");
class UserRepository {
    public function insertUser($data){
        $instance = new ConnectBDD();
        // var_dump($instance->connect());
        // var_dump($data->getPseudo());
        $sql = "INSERT INTO user (email, pseudo, pwd, pref, role) VALUES (:email,:pseudo,:pwd,:pref,:role)";
        $query = $instance->connect()->prepare($sql);
        $query->bindValue(":email", $data->getEmail(), PDO::PARAM_STR);
        $query->bindValue(":pseudo", $data->getPseudo(), PDO::PARAM_STR);
        $query->bindValue(":pwd", $data->getPwd(), PDO::PARAM_STR);
        $query->bindValue(":pref", serialize($data->getPref()), PDO::PARAM_STR);
        $query->bindValue(":role", serialize($data->getRole()), PDO::PARAM_STR);
        $query->execute();
    }
    public function selectOneBy($value,$table,$field,$select){
        $instance = new ConnectBDD();
        $sql = "SELECT $select FROM $table WHERE $field = :alias";
        $query = $instance->connect()->prepare($sql);
        $query->bindValue(":alias", $value, PDO::PARAM_STR);
        $query->execute();
        return $query->fetch();
    }
    
}
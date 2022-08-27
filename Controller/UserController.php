<?php
require_once("../Model/User.php");
require_once("../Controller/FormVerif.php");
require_once("../repository/UserRepository.php");
require_once("../Controller/SessionController.php");
require_once("../Controller/RouteController.php");
class UserController extends FormVerif {
    
    public $errors = [];
    public $post;
    public function verifOneExist($value,$name,$errors){
        // 
        $userRepository = new UserRepository;
        $result = $userRepository->selectOneBy($value,"user",$name,$name);
        if(is_array($result)){
            $errors[$name] = "Cet $name n'est pas disponible";
        }
        return $errors;
        // var_dump($errors);
    }
    public function verifLogin($valueEmail,$valuePwd,$errors){
        $userRepository = new UserRepository;
        $resultEmail = $userRepository->selectOneBy($valueEmail,"user","email","email,pwd");
        $resultPseudo = $userRepository->selectOneBy($valueEmail,"user","pseudo","pseudo,pwd");
        if(is_array($resultPseudo) || is_array($resultEmail)){ 
            if(is_array($resultPseudo)){
                $pwd = $resultPseudo["pwd"];
                // var_dump($pwd);
            } else if (is_array($resultEmail)){
                $pwd = $resultEmail["pwd"];
                // var_dump($pwd);
            } 
            if(password_verify($valuePwd,$pwd)){
                echo "vous êtes maintenant connectés";
            } else {
                $errors["pwd"] = "Le mot de passe est incorrect!";
            }
        } else {
            $errors["email"] = "Votre identifiant est incorrect!";
        }
        return $errors;
    }
    public function register($post){
        if(isset($post["send"]) && !empty(($post["send"]))){

            $post = $this->stripTagsArray($post);
            $this->errors = $this->emptyField($post["pseudo"], "pseudo",$this->errors);
            $this->errors = $this->emptyField($post["email"], "email",$this->errors);
            $this->errors = $this->emptyField($post["pwd"], "pwd",$this->errors);
            $this->errors = $this->emptyField($post["confirmPwd"], "confirmPwd",$this->errors);
            $this->errors = $this->verifEmail($post["email"], "email",$this->errors);
            $this->errors = $this->identikPwd($post["pwd"],$post["confirmPwd"],"pwd",$this->errors);
            $this->errors = $this->verifPwd($post["pwd"], "pwd",$this->errors);
            $this->errors = $this->verifOneExist($post["email"], "email",$this->errors);
            $this->errors = $this->verifOneExist($post["pseudo"], "pseudo",$this->errors);
            if (count($this->errors) === 0){
                //  les données de mon formulaire sont valide, 
                // je peux implémenter un new user et l'inserer dans la BDD
                var_dump($this->post);
                $post["pref"] = ['void'];
                $post["role"] = ["ROLE_USER"];
                $post["pwd"] = $this->pwdHash($post["pwd"]);
                $user = new User($post["email"],$post["pseudo"],$post["pwd"],$post["pref"],$post["role"]);
                // insertion du new User
                $user->insertUser($user);
                $userRepository = new userRepository;
                $userData = $userRepository->selectOneBy($post["email"],"user","pseudo","*");
                SessionController::newSession([],$userData);
                $routeController = new RouteController($_SERVER);
                header("Location: ".$routeController->getRoute("index"));
            }
            // var_dump($this->post);
        }
    }
    public function login($post,$session){
        if(isset($post["send"]) && !empty(($post["send"]))){

            $post = $this->stripTagsArray($post);
            $this->errors = $this->emptyField($post["email"], "email",$this->errors);
            $this->errors = $this->emptyField($post["pwd"], "pwd",$this->errors);
            $this->errors = $this->verifLogin($post["email"],$post["pwd"],$this->errors);

            if(count($this->errors) === 0){
                $userRepository = new userRepository;
                $userData1 = $userRepository->selectOneBy($post["email"],"user","email","*");
                $userData2 = $userRepository->selectOneBy($post["email"],"user","pseudo","*");
                if(is_array($userData1)){
                    $userData = $userData1;
                }
                if(is_array($userData2)){
                    $userData = $userData2;
                }
                // var_dump($userData);
                SessionController::newSession($session,$userData);
                $routeController = new RouteController($_SERVER);
                header("Location: ".$routeController->getRoute("index"));
            }
        }
    }
}
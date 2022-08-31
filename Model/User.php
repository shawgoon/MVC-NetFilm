<?php
if($_SERVER['PHP_SELF'] === '/NetFilm/index.php'){
    $pref = './';
} else {
    $pref = '../';
}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);

require_once($routeController->getRepository("UserRepository"));

class User extends UserRepository {
    public function __construct(
        $email,
        $pseudo,
        $pwd,
        $pref,
        $role
        )
    {
        $this->setEmail($email);
        $this->setPseudo($pseudo);
        $this->setPwd($pwd);
        $this->setPref($pref);
        $this->setRole($role);
    }
    // propriétés de la class
    private $id_user;
    private $email;
    private $pseudo;
    private $pwd;
    private $pref;
    private $role;
    /**
     * Fonction de vérification de valeur transmises à mes setter
     *
     * @param [type] $value     // valeur transmise à mon setter
     * @param [string] $champs  // nom du champs de la table de la BDD
     * @param [type] return/ propriete de la class affectée
     * @param [type] $type      // type de la valeur acceptée (int,string,bool,array)
     * @param [type] $empty     // true = la valeur ne peut être null
     * @return void
     */
    public function controlSetter($value,$champ,$type,$empty){
        if ($empty && !empty($value) && $empty !== "") {
            if ($type === 'int' && is_int($value)) {
                return $value;
            } else if ($type === 'string' && is_string($value)) {
                return $value;
            } else if ($type === 'bool' && is_bool($value)) {
                return $value;
            } else if ($type === 'array' && is_array($value)) {
                return serialize($value);
            } else {
                throw new Exception("$champ doit être de type $type !");
            }
        } else {
            throw new Exception("$champ ne doit pas être vide !");
        }
    }
    public function getId_user() {
        return $this->id_user;
    }
    public function setId_user($id_user){
       $this->id_user = $this->controlSetter($id_user,"id_user","int",true);
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email){
       $this->email = $this->controlSetter($email,"email","string",true);
    }
    public function getPseudo() {
        return $this->pseudo;
    }
    public function setPseudo($pseudo){
       $this->pseudo = $this->controlSetter($pseudo,"pseudo","string",true);
    }
    public function getPwd() {
        return $this->pwd;
    }
    public function setPwd($pwd){
       $this->pwd = $this->controlSetter($pwd,"pwd","string",true);
    }
    public function getPref() {
        $pref = unserialize($this->pref);
        return $pref;
    }
    public function setPref($pref){
       $this->pref = $this->controlSetter($pref,"pref","array",true);
    }
    public function getRole() {
        $role = unserialize($this->role);
        return $role;
    }
    public function setRole($role){
       $this->role = $this->controlSetter($role,"role","array",true);
    }
    public function getSession() {
        $session = $this->session;
        return $session;
    }
    public function setSession($session){
       $this->session = $this->controlSetter($session,"role","array",true);
    }
}
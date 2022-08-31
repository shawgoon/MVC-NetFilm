<?php
class RouteController {
    public function __construct($server){
        $this->server = $server;
        if( $server['PHP_SELF'] === '/NetFilm/index.php'){
            $this->rootDir = ".";
        } else {$this->rootDir = '..';}
        // var_dump($server);
    }
    private $server;
    private $rootDir;
    private $viewDir = "/View/";
    private $controlDir = "/Controller/";
    private $modelDir  = "/Model/";
    private $repositoryDir = "/Repository/";
    private $incDir = "/inc/";
    private $ext = ".php";

    public function getRoute($route){
        if($route === "index"){
            return $this->rootDir;
        } else {
            return $this->rootDir.$this->viewDir.$route.$this->ext;
        }
        // if($route === "index" ){
        //     $path = substr($this->server["REQUEST_URI"], 0, strpos($this->server["REQUEST_URI"], "/view"));
        //     return $path.$this->rootDir;
        // } else {
        //     $path = substr($this->server["REQUEST_URI"], 0, strpos($this->server["REQUEST_URI"], "/view")); // index.php
        //     return $path.$this->rootDir.$this->viewDir.$route.$this->ext;
        // }
    }    
    public function getController($route){    
        return $this->rootDir.$this->controlDir.$route.$this->ext; 
    }
    public function getModel($route){
        return $this->rootDir.$this->modelDir.$route.$this->ext; 
    }
    public function getRepository($route){
        return $this->rootDir.$this->repositoryDir.$route.$this->ext; 
    }
    public function getInc($route){   
        return $this->rootDir.$this->incDir.$route.$this->ext; 
    }
    public function getAssets(){   
        return $this->rootDir."/assets/"; 
    }
}
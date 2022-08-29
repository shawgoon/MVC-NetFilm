<?php
class RouteController {
    public function __construct($server){
        $this->server = $server;
        // var_dump($server);
    }
    private $server;
    private $rootDir = "/NetFilm";
    private $viewDir = "/View/";
    private $controlDir = "/Controller/";
    private $ext = ".php";

    public function getRoute($route){
        if($route === "index" ){
            $path = substr($this->server["REQUEST_URI"], 0, strpos($this->server["REQUEST_URI"], "/view"));
            return $path.$this->rootDir;
        } else {
            $path = substr($this->server["REQUEST_URI"], 0, strpos($this->server["REQUEST_URI"], "/view")); // index.php
            return $path.$this->rootDir.$this->viewDir.$route.$this->ext;
        }
    }
    public function getController($route){
        if(strpos($this->server["REQUEST_URI"],"index")){
            $path = substr($this->server["REQUEST_URI"],0,strpos($this->server["REQUEST_URI"],"/index.php"));
        } else {
            $path = substr($this->server["REQUEST_URI"],0,strpos($this->server["REQUEST_URI"],"/view"));
        }
        $root = $this->server['CONTEXT_DOCUMENT_ROOT'].$path;
        // var_dump($root.$this->root.$this->controlDir.$route.$this->ext);
        return $root.$this->rootDir.$this->controlDir.$route.$this->ext; 
    }
}
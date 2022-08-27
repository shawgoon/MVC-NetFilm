<?php
require_once("../inc/connectBDD.php");
class FilmRepository {
    public function showFilm(){
        $instance = new ConnectBDD();
        $sql = "SELECT id_movie,title,year,genres,directors,cast,plot FROM  movies_full ORDER BY RAND() LIMIT 10";
        $query = $instance->connect()->prepare($sql);
        $query->execute(); 
        $result = $query->fetchAll();
        echo json_encode($result);
        return $result;           
    }
}
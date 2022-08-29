<?php
require_once("../inc/connectBDD.php");
class FilmRepository {
    public function showFilm(){
        $instance = new ConnectBDD();
        $sql = "SELECT id_movie,title,year,genres,directors,cast,plot FROM  movies_full ORDER BY RAND() LIMIT 10";
        $query = $instance->connect()->prepare($sql);
        $query->execute(); 
        $result = $query->fetchAll();
        return $result;           
    }
    public function getFilmById($id){
        // var_dump($id);
        $instance = new ConnectBDD();
        $rq = "SELECT * FROM movies_full WHERE id_movie = :id";
        $requete = $instance->connect()->prepare($rq);
        // protéger une variable dans la requete
        $requete->bindValue(":id",$id,PDO::PARAM_INT);
        $requete->execute();
        $result = $requete->fetch();
        // var_dump($result);
        $film = new Film(
            intval($result["id_movie"]),
            $result["title"],
            intval($result["year"]),
            $result["genres"],
            $result["plot"],
            $result["directors"],
            $result["cast"]
        );
        var_dump($result["title"]);
        var_dump($film->getTitle());
        return $film;
    }
}
<?php
// require_once("../inc/pdo.php");
require_once("../Model/Film.php");
require_once("../repository/FilmRepository.php");
// require_once("../Controller/RouteController.php");
class FilmController extends FilmRepository{
    public static function getFilmById($id,$instance){
        // var_dump($id);
        $rq = "SELECT * FROM movies_full WHERE id_movie = :id";
        $requete = $instance->prepare($rq);
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
    public function showMovies(){

    }
}
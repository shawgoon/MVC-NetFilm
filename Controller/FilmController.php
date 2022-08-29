<?php
// require_once("../inc/pdo.php");
require_once("../Model/Film.php");
require_once("../repository/FilmRepository.php");
// require_once("../Controller/RouteController.php");
class FilmController extends FilmRepository{
    
    public static function showMovies($nbFilm){
        $urlPoster = "../assets/img/posters/";
        $ext = ".jpg";
        $showMovies = new FilmRepository;
        $films = $showMovies->showFilm($nbFilm);
        foreach ($films as $key => $value){
            if(file_exists($urlPoster.$value["id_movie"].$ext)){
                $films[$key]["urlFilm"] = $urlPoster.$value["id_movie"].$ext;
            } else {
                $films[$key]["urlFilm"] = $urlPoster."default.jpg";
            }
        }
        // var_dump($films);
        return $films;
    }
}
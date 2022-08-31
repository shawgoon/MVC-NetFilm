<?php
if($_SERVER['PHP_SELF'] === '/NetFilm/index.php'){
    $pref = './';
} else {
    $pref = '../';
}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getmodel("Film"));
require_once($routeController->getRepository("FilmRepository"));
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
    public static function menuGenre(){
        $filmRepository = new FilmRepository;

        return $filmRepository->selectGenres();
    }
    public static function showGenre($genre,$currentPage){
        
        $genreRepository = new FilmRepository;
        $routeController = new RouteController($_SERVER);
        $urlPoster = $routeController->getAssets()."img/posters/";
        $ext = ".jpg";
        $nb = 20;
        if(is_numeric($currentPage)){
            $index = ($currentPage-1)*$nb;
        } else {
            $tmpCurrentPage = explode(",",$currentPage);
            $currentPage = intval($tmpCurrentPage[1]);
            $tmpCurrentPage[0]==="Prec" ? $currentPage-- : $currentPage++; 
            $index = ($currentPage-1)*$nb;
        }
        $genreFilms = $genreRepository->getFilmByGenre($genre,$index,$nb);
        foreach ($genreFilms as $key => $value){
            if(file_exists($urlPoster.$value["id_movie"].$ext)){
                $genreFilms[$key]["urlFilm"] = $urlPoster.$value["id_movie"].$ext;
            } else {
                $genreFilms[$key]["urlFilm"] = $urlPoster."default.jpg";
            }
        }
        return $genreFilms;
    }
    public static function getPage($genre){
        $ngByGenreRepository = new FilmRepository;
        $count = $ngByGenreRepository->pageByGenre($genre);
        $pages = ceil($count/20);
        return $pages;
    }
    public static function pageManager($currentPage,$pages,$activPrec,$activPage,$activSuiv) {
        $currentPage = strip_tags($_GET['currentPage']);
        if(!strpos($currentPage,",")) {
            $currentPage = intval($currentPage);
        }
        if (!is_numeric($currentPage)){
            $tmpCurrentPage = explode(",",$currentPage);
            if($tmpCurrentPage[0] === "Suiv"){
                $currentPage = intval($tmpCurrentPage[1])+1;
                $activPage = $currentPage;
                if($currentPage == $pages){
                    $activSuiv = true;
                }
            } else {
                if ($tmpCurrentPage[1] == 2){
                    $activPrec = true;
                } else {
                    $currentPage = intval($tmpCurrentPage[1])-1;
                    $activPage = $currentPage;
                }
            }
        } else {
            $activPage = $currentPage;
            if($currentPage == $pages){
                $activSuiv = true;
            }
            if ($currentPage == 1){
                $activPrec = true;
            }
        }
        return [$activPrec,$activPage,$activSuiv,$currentPage];
    }
    public static function getSearch($search){
        $searchRepository = new FilmRepository;
        // controle eventuel du resultat
        return $searchRepository->search($search);
    }
}
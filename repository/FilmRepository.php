<?php
if($_SERVER['PHP_SELF'] === '/NetFilm/index.php'){
    $pref = './';
} else {
    $pref = '../';
}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);

require_once($routeController->getInc("connectBDD"));
class FilmRepository {
    public function showFilm(){
        $instance = new ConnectBDD();
        $sql = "SELECT id_movie,title,year,genres,directors,cast,plot FROM  movies_full ORDER BY RAND() LIMIT 10";
        $query = $instance->connect()->prepare($sql);
        $query->execute(); 
        $result = $query->fetchAll();
        return $result;           
    }
    public function selectFilmById($id){
        // var_dump($id);
        $instance = new ConnectBDD();
        $rq = "SELECT * FROM movies_full WHERE id_movie = :id";
        $requete = $instance->connect()->prepare($rq);
        // protéger une variable dans la requete
        $requete->bindValue(":id",$id,PDO::PARAM_INT);
        $requete->execute();
        $result = $requete->fetch();
        // var_dump($result);
        return $result;
    }
    public function selectGenres(){
        $instance = new ConnectBDD();
        $sql = "SELECT substring_index(genres,',',1) 
        AS genre FROM  movies_full GROUP BY genre";
        $query = $instance->connect()->prepare($sql);
        $query->execute(); 
        $result = $query->fetchAll();
        return $result;           
    }
    public function getFilmByGenre($genre,$index,$nb){
        $instance = new ConnectBDD();
        $sql ="SELECT * FROM movies_full WHERE genres LIKE :genre LIMIT $index,$nb";
        $query = $instance->connect()->prepare($sql);
        $query->bindValue(":genre",'%'.$genre.'%',PDO::PARAM_STR);
        $query->execute(); 
        $result = $query->fetchAll();
        return $result; 
    }
    public function pageByGenre($genre){
        $instance = new ConnectBDD();
        $sql = "SELECT id_movie FROM movies_full WHERE genres LIKE :genre";
        $query = $instance->connect()->prepare($sql);
        $query->bindValue(":genre",'%'.$genre.'%',PDO::PARAM_STR);
        $query->execute(); 
        $result = $query->rowCount();
        return $result;
    }
    public function search($search){
        $instance = new ConnectBDD();
        $sql = "SELECT * FROM movies_full WHERE cast LIKE :search OR title LIKE :search OR directors LIKE :search LIMIT 0,20";
        $query = $instance->connect()->prepare($sql);
        $query->bindValue(":search",'%'.$search.'%',PDO::PARAM_STR);
        $query->execute(); 
        $result = $query->fetchAll();
        return $result;
    }
}
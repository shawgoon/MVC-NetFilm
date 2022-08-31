<?php
require_once("../Controller/FilmController.php");
$resultJson = FilmController::getSearch(strip_tags($_GET["resultat"]));
echo json_encode($resultJson);
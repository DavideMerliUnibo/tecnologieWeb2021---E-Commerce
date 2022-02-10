<?php 

require_once("bootstrap.php");
$templateParams["nome"] = "paginaRicetta-get.php";

$titoloRicetta = "";
if (isset($_GET["titoloRicetta"])){
    $titoloRicetta = $_GET["titoloRicetta"];
}
$templateParams["titoloRicetta"] = $dbh -> getRecipeByTitle($titoloRicetta);
$templateParams["tabella"] = $dbh -> getNutritionalTable($titoloRicetta);
$templateParams["ingredienti"] = $dbh -> getIngredientsForRecipe($titoloRicetta);
$templateParams["immaginiRicetta"] = $dbh -> getRecipeImages($titoloRicetta);
$templateParams["commenti"] = $dbh -> getRecipeComments($titoloRicetta);

require("template/base.php");

?>

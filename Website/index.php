<?php 

require_once("bootstrap.php");
$templateParams["nome"] = "mainMenu.php";
$templateParams["title"] = "Funghi - Home";
$templateParams["nuoviProdotti"] = $dbh -> getLatestProducts(2);
$templateParams["nuoveRicette"] = $dbh -> getLatestRecipes(2);
$templateParams["css"] = ["css/mainMenu.css"];
require("template/base.php");
?>
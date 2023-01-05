<?php

    require_once("bootstrap.php");
    $templateParams["nome"] = "ricette.php";
    $templateParams["title"] = "Funghi - Ricette";
    if(isset($_GET["username"])){
        $templateParams["ricette"] = $dbh -> getRicetteUtenteByUsername($_GET["username"]);
    }else{
        $templateParams["ricette"] = $dbh -> getRecipes();
    }
    require("template/base.php");

<?php

    require_once("bootstrap.php");
    $templateParams["nome"] = "ricette.php";
    $templateParams["title"] = "Funghi - Ricette";
    $templateParams["ricette"] = $dbh -> getRecipes();
    require("template/base.php");

?>
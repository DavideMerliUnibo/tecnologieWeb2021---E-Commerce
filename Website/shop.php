<?php
    require_once("bootstrap.php");
    $templateParams["nome"] = "shop.php";
    $templateParams["title"] = "Funghi - Shop";
    $templateParams["prodotti"] = $dbh -> getProducts();
    require("template/base.php");
?>
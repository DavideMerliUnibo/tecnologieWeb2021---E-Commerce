<?php
    require_once("bootstrap.php");
    $templateParams["nome"] = "shop.php";
    $templateParams["title"] = "Funghi - Shop";
    if(isset($_GET['username'])){
        $templateParams["prodotti"] = $dbh -> getProdottiUtenteByUsername($_GET["username"]);
    } else {
        $templateParams["prodotti"] = $dbh -> getProducts();
    }
    require("template/base.php");
?>
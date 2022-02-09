<?php 
    require_once("bootstrap.php");
    $templateParams["nome"] = "product.php";

    $idprodotto = -1;
    if (isset($_GET["prodotto"])){
        $idprodotto = $_GET["prodotto"];
    }
    $templateParams["prodotto"] = $dbh -> getProductById($idprodotto);
    $templateParams["immagini"] = $dbh -> getProductImages($idprodotto);
    $templateParams["recensioni"] = $dbh -> getProductReviews($idprodotto);

    require("template/base.php");
?>
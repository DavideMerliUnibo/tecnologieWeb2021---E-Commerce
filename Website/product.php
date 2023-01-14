<?php
require_once("bootstrap.php");
$templateParams["nome"] = "product.php";
$templateParams["title"] = "Funghi - Prodotto";

$idprodotto = -1;
if (isset($_GET["prodotto"])) {
    $idprodotto = $_GET["prodotto"];
}
$templateParams["prodotto"] = $dbh->getProductById($idprodotto);
$templateParams["immagini"] = $dbh->getProductImages($idprodotto);
$templateParams["recensioni"] = $dbh->getProductReviews($idprodotto);
$templateParams["css"] = ['css/product.css'];
require("template/base.php");

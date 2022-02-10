<?php 

require_once("bootstrap.php");
$templateParams["nome"] = "carrello-get.php";
$templateParams["prodottiCarrello"] = $dbh-> getProductInCart($_SESSION['email']);

require("template/base.php");
?>
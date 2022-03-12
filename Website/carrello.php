<?php 

require_once("bootstrap.php");

$templateParams["title"] = "Funghi - Carrello";
if(isUserloggedIn()){
    $templateParams["prodottiCarrello"] = $dbh-> getProductInCart($_SESSION['email']);
    $templateParams["nome"] = "carrello-get.php";
} else {
    $templateParams["nome"] = "carrello-no-user.php";
}
require("template/base.php");
?>
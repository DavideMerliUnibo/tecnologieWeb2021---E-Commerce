<?php 

require_once("bootstrap.php");
$templateParams["nome"] = "carrello-get.php";
$templateParams["title"] = "Funghi - Carrello";
if(isUserloggedIn()){
    $templateParams["prodottiCarrello"] = $dbh-> getProductInCart($_SESSION['email']);
}else{
    die("user not logged in");
}
require("template/base.php");
?>
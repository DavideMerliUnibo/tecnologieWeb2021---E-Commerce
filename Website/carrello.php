<?php 

require_once("bootstrap.php");

$templateParams["title"] = "Funghi - Carrello";
if(isUserloggedIn()){
    $templateParams["prodottiCarrello"] = $dbh-> getProductInCart($_SESSION['email']);
    $templateParams["nome"] = "carrello-get.php";
} else {
    $templateParams["nome"] = "carrello-no-user.php";
}
if(isset($_POST["metodoPagamento"])){
    echo var_dump($_POST);
    echo var_dump("ciao");
    die();
}
require("template/base.php");

?>
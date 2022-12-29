<?php 

require_once("bootstrap.php");

$templateParams["title"] = "Funghi - Carrello";
if(isUserloggedIn()){
    $templateParams["prodottiCarrello"] = $dbh-> getProductsInCart($_SESSION['email']);
    $templateParams["nome"] = "carrello-get.php";
} else {
    $templateParams["nome"] = "carrello-no-user.php";
}
if(isset($_POST["metodoPagamento"]) && isset($_POST["nomeCarta"]) && isset($_POST["numeroCarta"]) 
    && isset($_POST["scadenzaCarta"]) && isset($_POST["ccvCarta"]) ){
        $result = $dbh->insertAcquisto($_POST["metodoPagamento"],$_POST["nomeCarta"], $_POST["numeroCarta"],$_POST["scadenzaCarta"],$_POST["ccvCarta"]);
        if( $result=="success"){
            $dbh -> insertNotifica("Acquisto avvenuto con successo!", $_SESSION["email"]);
            $templateParams["toast"] = "success";
        } else  {
            $templateParams["toast"] = "error";
            $_GET["error"]=true;
        }
        header("location: /tecnologieWeb2021---E-Commerce/Website/confermaAcquisto.php");
}
require("template/base.php");

?>
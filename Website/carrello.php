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
        echo $result;
        if( $result=="success"){
            //far comparire popup o qualcosa per avvertire che ordine è andato a buon fine. (anche un altra pagina volendo).
            //gestire casi d'errore
        }
}
require("template/base.php");

?>
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
            $prodotti = $dbh -> getProdottiInAcquisto($dbh -> getLatestAcquisto()[0]["codice"]);
            foreach ($prodotti as $prodotto){
                if($prodotto["quantità"] == 1){
                    $dbh -> insertNotifica("E' stato acquistato un " .$prodotto["nomeFungo"] .".", $prodotto["offerente"]);
                } else {
                    $dbh -> insertNotifica("Sono stati acquistati " .$prodotto["quantità"] ." " .$prodotto["nomeFungo"] .".", $prodotto["offerente"]);
                }
                if ($dbh -> getProductById($prodotto["codice"])[0]["quantità"] == 0){
                    $dbh -> insertNotifica("Il prodotto " .$prodotto["nomeFungo"] ." è esaurito.", $prodotto["offerente"]);
                }
            }
            $dbh -> svuotaCarrello($_SESSION["email"]);
            $templateParams["toast"] = "success";
        } else  {
            $templateParams["toast"] = "error";
        }
        header("location: /tecnologieWeb2021---E-Commerce/Website/confermaAcquisto.php");
}
require("template/base.php");

?>
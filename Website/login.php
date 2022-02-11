<?php
require_once("bootstrap.php");
if (isset($_POST['email']) && isset($_POST['password'])) {
    $result = $dbh->checkUser($_POST["email"], $_POST["password"]);

    if (count($result) == 0) {
        //inserire messaggio errore in login form 
        $templateParams["erroreLogin"] = "Username o Password errati";
    } else {
        registerLoggedUser($result[0]);
    }
}

// if (isset($_POST["submitRicetta"]) && isUserLoggedIn()) {
//     $data = json_decode($_POST["data"], true);
//     $dbh->insertRicetta($data["titolo"], $data["difficolta"], $data["descrizione"], $data["procedimento"], $data["consigli"], $data["valEnergetico"], $data["proteine"], $data["grassi"], $data["carboidrati"], $data["fibre"], $data["sodio"]);
// }


if (isUserLoggedIn()) {
    header("location: home-utente.php");
    die();
    //$templateParams["nome"] = "login-home.php";
} else {
    //sostituire anche titolo
    //$templateParams["titolo"] = 'Login';
    $templateParams["nome"] = "login-form.php";
    $templateParams["title"] = "Funghi - Login";
}

require("template/base.php");
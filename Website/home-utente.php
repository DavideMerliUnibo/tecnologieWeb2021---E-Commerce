<?php 
require_once "bootstrap.php";
if(!isUserLoggedIn()){
    die();
}
$templateParams["nome"] = "home.php";
$templateParams["ricette"] = $dbh->getRicetteUtente();
if (isset($_POST["submitRicetta"]) && isUserLoggedIn()) {
    $data = json_decode($_POST["data"], true);
    $dbh->insertRicetta($data["titolo"], $data["difficolta"], $data["descrizione"], $data["procedimento"], $data["consigli"], $data["valEnergetico"], $data["proteine"], $data["grassi"], $data["carboidrati"], $data["fibre"], $data["sodio"]);
}
require "template/base.php";
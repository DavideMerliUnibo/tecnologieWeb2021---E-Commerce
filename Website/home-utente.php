<?php
require_once "bootstrap.php";
if (!isUserLoggedIn()) {
    die();
}
$templateParams["nome"] = "home.php";
$templateParams["title"] = "Funghi - User homepage";
//if se al posto di gestisci ricette voglio qualcos'altro 
if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "gestisciRicette":
            $templateParams["inner"] = "gestisci-ricette.php";
            break;
        case "gestisciProdotti":
            $templateParams["inner"] = "gestisci-prodotti.php";
            break;
        case "gestisciInfoUtente":
            $templateParams['inner'] = "gestisci-info-utente.php";
            break;
        case "visualizzaProdottiVenduti":
            $templateParams["inner"] = "prodotti-venduti.php";
            break;
        case "visualizzaAcquisti":
            $templateParams["inner"] = "acquisti-passati.php";
            break;
        case "visualizzaNotifiche":
            $templateParams["inner"] = "notifiche.php";
            break;
    }
} else {
    $templateParams["inner"] = "gestisci-prodotti.php";
}
require "template/base.php";

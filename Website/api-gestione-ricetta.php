<?php
require("/xampp/htdocs/tecnologieWeb2021---E-Commerce/Website/bootstrap.php");
if (isUserLoggedIn()) {
    if (isset($_POST["action"])) {
        switch ($_POST["action"]) {
            case "delete":
                if (isset($_POST["titolo"])) {
                    $dbh->deleteRicetta($_POST['titolo']);
                }
                break;
            case "content":
                header("Content-type: application/json");
                $ricette = $dbh->getRicetteUtente();
                echo json_encode($ricette);
            case "insert":
                if (isset($_POST["submitRicetta"])) {
                    $data = json_decode($_POST["data"], true);
                    $dbh->insertRicetta($data["titolo"], $data["difficoltà"], $data["descrizione"], $data["procedimento"], $data["consigli"], $data["valoreEnergetico"], $data["proteine"], $data["grassi"], $data["carboidrati"], $data["fibre"], $data["sodio"]);
                }
        }
    }
}

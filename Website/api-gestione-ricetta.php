<?php
require("bootstrap.php");
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
                break;
            case "insert":
                if (isset($_POST["submitRicetta"])) {
                    $data = json_decode($_POST["data"], true);
                    $dbh->insertRicetta($data["titolo"], $data["difficoltà"], $data["descrizione"], $data["procedimento"], $data["consigli"], $data["valoreEnergetico"], $data["proteine"], $data["grassi"], $data["carboidrati"], $data["fibre"], $data["sodio"]);
                }
                break;
            case 'update':
                if (isset($_POST['submitRicetta'])) {
                    $data = json_decode($_POST["data"], true);
                    $chiave = $_POST['titolo'];
                    $dbh->updateRicetta($data["titolo"], $data["difficoltà"], $data["descrizione"], $data["procedimento"], $data["consigli"], $data["valoreEnergetico"], $data["proteine"], $data["grassi"], $data["carboidrati"], $data["fibre"], $data["sodio"], $chiave);
                }
                break;
            case 'img':
                if (isset($_POST['titolo'])) {
                    header("Content-type: application/json");
                    echo json_encode($dbh->imagesRecipe($_POST['titolo']));
                }
                break;
            case 'imgRemove':
                if (isset($_POST['titolo']) && isset($_POST['nome'])) {
                    $dbh->removeImageFromRecipe($_POST['nome'], $_POST['titolo']);
                }
                break;
            case 'imgInsert':
                
                // if (isset($_POST['titolo']) && isset($_POST['nome'])) {
                //     $dbh->insertImageToRecipe($_POST['nome'], $_POST['titolo']);
                // }
                break;
        }
    }
}

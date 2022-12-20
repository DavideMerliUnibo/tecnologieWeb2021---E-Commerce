<?php
require("bootstrap.php");
if (isUserLoggedIn()) {
    if (isset($_POST["action"])) {
        switch ($_POST["action"]) {
            case "content":
                header("Content-type: application/json");
                $prodotti = $dbh->getProdottiUtente();
                echo json_encode($prodotti);
                break;
            case "delete":
                if (isset($_POST["codice"])) {
                    $dbh->deleteProdotto($_POST['codice']);
                }
                break;
            case 'update':
                if (isset($_POST['submitProdotto'])) {
                    $data = json_decode($_POST["data"], true);
                    $chiave = $data["idProdotto"];
                    $dbh->updateProdotto($data["nomeFungo"], $data["descrizione"], $data["quantità"], $data["prezzoUnità"], $chiave);
                }
                break;
            case "insert":
                if (isset($_POST["submitProdotto"])) {
                    $data = json_decode($_POST["data"], true);
                    $dbh->insertProdotto($data["nomeFungo"],  $data["prezzoUnità"],$data["quantità"],$data["descrizione"]);
                }
                break;
            case 'img':
                if (isset($_POST['codice'])) {
                    header("Content-type: application/json");
                    echo json_encode($dbh->imagesProduct($_POST['codice']));
                }
                break;
            case 'imgRemove':
                if (isset($_POST['codice']) && isset($_POST['nome'])) {
                    $dbh->removeImageFromProduct($_POST['nome'], $_POST['codice']);
                }
                break;
            //... altri case
        }
    }
}
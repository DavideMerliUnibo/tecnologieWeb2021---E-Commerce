<?php
require("bootstrap.php");
if (isUserLoggedIn()) {
    if (isset($_POST["action"])) {
        switch ($_POST["action"]) {
            case "aggiungiAlCarrello":
                if (isset($_POST["codProd"]) && isset($_POST["qty"])) {
                    echo  $dbh->addProductToCart($_POST['codProd'], $_POST["qty"]);
                }
                break;

            case "aggiornaCarrelloQty":
                if (isset($_POST["codProd"]) && isset($_POST["qty"])) {
                    echo  $dbh->updateQtyProductCart($_POST['codProd'], $_POST["qty"]);
                }
                break;
        }
    }
}

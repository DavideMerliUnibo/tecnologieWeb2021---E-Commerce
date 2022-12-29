<?php
require("bootstrap.php");
if (isUserLoggedIn()) {
    if (isset($_POST["action"])) {
        switch ($_POST["action"]) {
            case "aggiungiAlCarrello":
                if(isset($_POST["codProd"]) && isset($_POST["qty"])){
                    if($dbh->addProductToCart($_POST['codProd'],$_POST["qty"])){
                        return "success";
                    }
                    return "failure";
                }
                break;
        }
    }
}

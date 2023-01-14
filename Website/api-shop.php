<?php
require("bootstrap.php");

if (isUserLoggedIn()) {
    if (isset($_POST["action"])) {
        switch ($_POST["action"]) {
            case 'illegal':
                header("content-type","application/json");
                echo json_encode($dbh->getProductsIllegal());
                break;
        }
    }
}
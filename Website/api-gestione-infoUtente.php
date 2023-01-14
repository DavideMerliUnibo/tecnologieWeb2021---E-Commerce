<?php
require("bootstrap.php");
if (isUserLoggedIn()) {
    if (isset($_POST["action"])) {
        switch ($_POST["action"]) {
            case "currentInfo":
                header("Content-type: application/json");
                $user = $dbh->getCurrentUser();
                echo json_encode($user);
                break;
            case "updateUser":
                if(isset($_POST["data"])){

                    $user = json_decode($_POST["data"],true);
                    $dbh->updateUser($user["nome"],$user["cognome"],$user["email"],$user["password"],$user["username"],$user["indirizzo"],$user["dataNascita"],$user["infoUtente"]);
                }
                break;
        }
    }
}

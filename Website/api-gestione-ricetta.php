<?php
require("/xampp/htdocs/project/Website/bootstrap.php");
if(isUserLoggedIn()){}
 if( isset($_POST["action"]) ){
    switch ($_POST["action"]){
        case "delete":
            if(isset($_POST["titolo"])){
                $dbh->deleteRicetta($_POST['titolo']);
            }
            break;
        case "content":
                header("Content-type: application/json" );
                $ricette = $dbh->getRicetteUtente();
                echo json_encode($ricette);
    }
}
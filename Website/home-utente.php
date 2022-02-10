<?php 
require_once "bootstrap.php";
if(!isUserLoggedIn()){
    die();
}
$templateParams["nome"] = "home.php";
//if se al posto di gestisci ricette voglio qualcos altro 
$templateParams['inner']= "gestisci-ricette.php";
$templateParams["ricette"] = $dbh->getRicetteUtente();
require "template/base.php";
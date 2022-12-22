<?php
require "bootstrap.php";

if(!isset($_GET["username"])){
    die();
}
$templateParams["user"] = $dbh->getUtente($_GET["username"])[0];
$templateParams["nome"] = "template/venditore.php";
$templateParams["title"] = "Pagina Venditore";

require("template/base.php");

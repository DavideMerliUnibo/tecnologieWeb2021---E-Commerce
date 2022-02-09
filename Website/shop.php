<?php
    require_once("bootstrap.php");
    $templateParams["nome"] = "shop.php";
    $templateParams["prodotti"] = $dbh -> getProducts();
    require("template/base.php");
?>
<?php 
    require_once("bootstrap.php");
    
    if(isset($_POST['email']) && isset($_POST['password'])){
        $result = $dbh->checkUser($_POST["email"],$_POST["password"]);

        if(count($result)==0){
            //inserire messaggio errore in login form 
            $templateParams["erroreLogin"] = "Username o Password errati";
        } else {
            registerLoggedUser($result[0]);
        }
    }

    if(isUserLoggedIn()){
        //reindirizzo alla main page utente al posto di login-form.php
        var_dump($_SESSION["email"]);
        $templateParams["nome"] = "login-form.php";

    } else {
        //sostituire anche titolo
        //$templateParams["titolo"] = 'Login';
        $templateParams["nome"] = "login-form.php";
    }

    require("template/base.php");



?>
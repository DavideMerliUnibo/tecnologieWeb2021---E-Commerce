<?php
    function registerLoggedUser($user){
        $_SESSION["email"] = $user["email"];
        $_SESSION["username"] = $user["username"];
    }
    
    function isUserLoggedIn(){
        return !empty($_SESSION["email"]);
    }
?>
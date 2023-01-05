<?php
  require_once("bootstrap.php");
  $templateParams["title"] = "Funghi - Registrazione";
  if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["nome"]) && isset($_POST["cognome"]) 
      && isset($_POST["indirizzo"]) && isset($_POST["dataNascita"]) && isset($_POST["email"]) && isset($_POST["infoUtente"])) {
        $success = $dbh->registerUser($_POST["nome"],$_POST["cognome"],$_POST["email"],$_POST["password"],$_POST["username"],$_POST["indirizzo"],$_POST["dataNascita"],$_POST["infoUtente"]);
        if(!$success){
          $templateParams['errorMessage'] = "Errore nella registrazione. Si prega di riprovare.";
          $templateParams["nome"] = "registrazione-form.php";
          
        } else {
          $dbh->createCart($_POST["email"]);
          $templateParams["nome"] = "signUpSuccess.php";
          $templateParams["title"] = "Funghi - Registrato!";
          $dbh -> insertNotifica("Registrazione avvenuta con successo!
          Benvenuto su tuttofungo.it. Qui puoi mettere in vendita i tuoi prodotti e condividere ricette con altri amanti dei funghi!", $_POST["email"]);
        }
  } else
  {
    $templateParams["nome"] = "registrazione-form.php";
  }
  //TODO:se utente gia` loggato disabilitare registrazione
  
  require("template/base.php")

  ?>
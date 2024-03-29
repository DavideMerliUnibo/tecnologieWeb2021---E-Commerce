<!DOCTYPE html>

<html lang="it">

    <head>
        <meta charset="utf-8"/>
        <title><?php echo $templateParams["title"]; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <!-- For toast -->
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
        <!-- for star rating -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <?php if(isset($templateParams["css"]) && count($templateParams["css"])!= 0){
            foreach($templateParams["css"] as $script): ?>
                <link rel="stylesheet" type="text/css" href="<?php echo $script?>"/>
        <?php endforeach; } ?>
        
        <script src="js/jquery-3.6.0.min.js"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
        <script src="js/navbarOpenClose.js"></script>
    </head>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg mb-3" style="background: url('./img/topbar.jpg') no-repeat center; background-size: cover;">
            <div class="container-fluid">

                <!-- Menu button -->
                <button  class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation" id="menuButton">
                    <img src="img/menu.png" alt="Menu" width="50" height="50" />
                </button>
                <!-- Logo -->
                <a href="index.php" id="logo" class="d-flex">
                    <img src="img/logo.svg" alt="logo" width="50" height="50" class="m-auto"/>
                </a>
                <!-- Shopping cart button -->
                <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#cart" aria-controls="cart" aria-expanded="false" aria-label="Toggle navigation" id="cartButton">
                    <img src="img/shopping_cart.png" alt="Shopping cart" width="50" height="50" />
                </button>
                

                <!-- Left Menu -->
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="login.php">Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="ricette.php">Ricette</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="faq.php">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="aboutus.php">About Us</a>
                        </li>
                    </ul>
                </div>

                <!-- Right Menu -->
                <div class="collapse navbar-collapse justify-content-end" id="cart">
                    <ul class="navbar-nav ">
                        <?php 
                        if(!isUserloggedIn()){
                            echo '<li class="nav-item text-white">Devi loggarti per vedere il carrello</li>';   
                        }
                        else{
                            $templateParams["prodottiCarrello"] = $dbh-> getProductsInCart($_SESSION['email']);
                            if(count($templateParams["prodottiCarrello"])==0){
                                echo '<li class="nav-item text-white">Carrello Vuoto</li>';   
                            } else{
                                echo '<li class="nav-item"> <a id="carrelloBtnLetters" class="btn btn-outline-success" href="carrello.php"> Visualizza carrello</a> </li> ';
                            }
                        }?>
                        
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            <?php require($templateParams["nome"]);?>
        </main>

        <footer class="text-center text-white" style="background: url('./img/bottombar.jpg') no-repeat center; background-size: cover;">
            <p>Sito realizzato da Davide Merli, Manuel Luzietti e Ryan Perrina</p>
            <p>Tecnologie Web - 2022</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </body>
</html>
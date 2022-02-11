<!DOCTYPE html>

<html lang="it">

    <head>
        <meta charset="utf-8"/>
        <title><?php echo $templateParams["title"]; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/navbarOpenClose.js"></script>
    </head>

    <body>     
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg mb-3">
            <div class="container-fluid">

                <!-- Menu button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation" id="menuButton">
                    <img src="img/menu.png" alt="Menu" width="50" height="50" />
                </button>
                <!-- Logo -->
                <a href="index.php">
                    <img src="img/logo.svg" alt="logo" width="50" height="50" />
                </a>
                <!-- Shopping cart button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#cart" aria-controls="cart" aria-expanded="false" aria-label="Toggle navigation" id="cartButton">
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
                <div class="collapse navbar-collapse" id="cart">
                    <ul class="navbar-nav">
                        <?php 
                        if(!isUserloggedIn()){
                            echo "Devi loggarti per vedere il carrello";   
                        }
                        else{
                            $templateParams["prodottiCarrello"] = $dbh-> getProductInCart($_SESSION['email']);
                            foreach($templateParams["prodottiCarrello"] as $prodotto){
                                echo '<li class="nav-item">';
                                echo '<a class="nav-link text-white" href="#">$prodotto["nomeFungo"]</a>';    
                                echo '</li>';
                            }
                        }?>
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="carrello.php">Visualizza carrello</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            <?php require($templateParams["nome"]);?>
        </main>

        <footer class="text-center text-white">
            <p>Sito realizzato da Davide Merli, Manuel Luzietti e Ryan Perrina</p>
            <p>Tecnologie Web - 2022</p>
        </footer>

    </body>
</html>
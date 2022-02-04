<!DOCTYPE html>

<html lang="it">

    <head>
        <meta charset="utf-8"/>
        <title>Page title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>

        <!-- For left menu -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="scripts/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </head>

    <body>     

        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <!-- Menu button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#leftMenu" aria-controls="leftMenu" aria-expanded="false" label="Toggle left menu">
                    <img src="img/menu.png" alt="Menu" width="50" height="50" />
                </button>

                <!-- Logo -->
                <a href="#">
                    <img src="img/logo.svg" alt="logo" width="50" height="50" />
                </a>

                <!-- Shopping cart button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#rightMenu" aria-controls="rightMenu" aria-expanded="false" label="Toggle right menu">
                    <img src="img/shopping_cart.png" alt="Shopping cart" width="50" height="50" />
                </button>

                <!-- Left menu -->
                <div class="collapse navbar-collapse" id="leftMenu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="login.html">Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Ricette</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">FAQ</a>
                        </li>
                    </ul>
                </div>

                <!-- Right menu -->
                <div class="collapse navbar-collapse" id="rightMenu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link  text-white" href="#">Articolo 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  text-white" href="#">Articolo 2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  text-white" href="#">Articolo 3</a>
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
    
        <script>
            function openLeftMenu() {
            document.getElementById("leftSideMenu").style.width = "255px";
            }
            function closeLeftMenu() {
            document.getElementById("leftSideMenu").style.width = "0";
            }
        </script>

    </body>
</html>
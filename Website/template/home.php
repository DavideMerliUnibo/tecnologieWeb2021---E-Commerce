<?php
// Funzione per eliminare una notifica
$thisPage = "http://localhost/tecnologieWeb2021---E-Commerce/Website/home-utente.php";
if (isset($_GET["action"])){
    $thisPage = $thisPage . "?action=" . $_GET["action"];
}

if(isset($_POST["logout"])){
    logOut();
}
if (isset($_POST["deleteNotifica"])) {
    $codiceNotifica = $_POST["notifica"];
    $dbh->deleteNotifica($codiceNotifica);
    header("Location: " . $thisPage);
    unset($_POST["deleteNotifica"]);
    unset($_POST["notifica"]);
}

// Funzione per gestire i messaggi delle notifiche
if (isset($_GET["toast"])) {
    switch ($_GET["toast"]) {
        case "addProd":
            echo '<script type="text/javascript">toastr.success("Prodotto inserito!");</script>';
            $dbh->insertNotifica("Prodotto inserito!", $_SESSION["email"]);
            break;
        case "deleteProd":
            echo '<script type="text/javascript">toastr.success("Prodotto eliminato!");</script>';
            $dbh->insertNotifica("Prodotto eliminato!", $_SESSION["email"]);
            break;
        case "updateProd":
            echo '<script type="text/javascript">toastr.success("Prodotto modificato!");</script>';
            $dbh->insertNotifica("Prodotto modificato!", $_SESSION["email"]);
            break;
        case "addImg":
            echo '<script type="text/javascript">toastr.success("Immagine aggiunta!");</script>';
            $dbh->insertNotifica("Immagine aggiunta!", $_SESSION["email"]);
            break;
        case "deleteImg":
            echo '<script type="text/javascript">toastr.success("Immagine eliminata!");</script>';
            $dbh->insertNotifica("Immagine eliminata!", $_SESSION["email"]);
            break;
        case "addRec":
            echo '<script type="text/javascript">toastr.success("Ricetta inserita!");</script>';
            $dbh->insertNotifica("Ricetta inserita!", $_SESSION["email"]);
            break;
        case "deleteRec":
            echo '<script type="text/javascript">toastr.success("Ricetta eliminata!");</script>';
            $dbh->insertNotifica("Ricetta eliminata!", $_SESSION["email"]);
            break;
        case "updateRec":
            echo '<script type="text/javascript">toastr.success("Ricetta modificata!");</script>';
            $dbh->insertNotifica("Ricetta modificata!", $_SESSION["email"]);
            break;
        case "updateInfo":
            echo '<script type="text/javascript">toastr.success("Info utente aggiornate!");</script>';
            $dbh->insertNotifica("Info utente aggiornate!", $_SESSION["email"]);
            break;
    }

    echo "<script>history.replaceState({},'','$thisPage');</script>";
    unset($_GET["toast"]);
} ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 ">
            <div class="row justify-content-between">
                <div class="col-4 col-lg-1">
                    <button class="btn btn-success ml-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">Menu</button>
                </div>

                <div class="col-4 col-lg-1 d-flex justify-content-end">
                    <form method="post" >
                        <input type="submit" name="logout" value="Log Out" class="btn btn-success ml-auto" style="white-space: nowrap;"/>
                    </form>
                </div>
            </div>
            <div class="offcanvas offcanvas-start" id="offcanvasMenu">
                <div class="offcanvas-body">
                    <div class="vstack mt-2">
                        <a class="btn" id="gestisciRicettiButton" href="/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=gestisciRicette">Gestisci ricette</a>
                        <a class="btn" id="gestisciProdottiButton" href="/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=gestisciProdotti">Gestisci prodotti</a>
                        <a class="btn" id="gestisciInfoButton" href="/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=gestisciInfoUtente">Gestisci info Utente</a>
                        <a class="btn" id="visualizzaVenditeButton" href="/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=visualizzaProdottiVenduti">Visualizza prodotti venduti</a>
                        <a class="btn" id="visulizzaAcquistiButton" href="/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=visualizzaAcquisti">Visualizza acquisti passati</a>
                        <a class="btn" id="notificheButton" href="/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=visualizzaNotifiche">Notifiche</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <section id="innerTemplate">
                    <?php
                    require($templateParams['inner']);
                    ?>
                </section>
            </div>
        </div>
    </div>
</div>

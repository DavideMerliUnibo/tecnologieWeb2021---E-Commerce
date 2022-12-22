<?php
$user = $templateParams["user"];
?>

<h1 class="text-center">Pagina Utente: <?php echo $user["username"] ?> </h1>
<h2 class="text-center">Informazioni:</h2>
<div class="container">
    <div class="row">
        <div class="col-12">
            <p>Nome: <?php echo $user["nome"] ?></p>
            <p>Cognome: <?php echo $user["cognome"] ?></p>
            <p>Email: <?php echo $user["email"] ?></p>
            <p>Email: <?php echo $user["email"] ?></p>
            <p>Indirizzo: <?php echo $user["indirizzo"] ?></p>
            <p>Data di nascita: <?php echo $user["data nascita"] ?></p>
            <p>Offerte vendute: <?php echo $user["offerteVendute"] ?></p>
            <p>Offerte inserite: <?php echo $user["offerteInserite"] ?></p>
            <p>Media Valutazioni: <?php echo $user["mediaValutazioni"] ?></p>
            <p>Info Venditore: <?php echo $user["info_venditore"] ?></p>
        </div>
        <div class="col-12">
            <h3 class="text-center">Prodotti in vendita:</h3>
            <?php $prodotti = $dbh->getProdottiUtenteByUsername($user["username"]);
            $x = 0;
            if (count($prodotti) < 3) {
                $x = count($prodotti);
            } else {
                $x = 3;
            }
            for ($i = 0; $i < $x; $i++) : ?>
                <section class="p-3">
                    <article class="row align-items-center bg-light border my-2 ">
                        <div class="col-4 col-lg-2 d-flex justify-content-center">
                            <img src="<?php echo UPLOAD_DIR . $prodotti[$i]["img"]; ?>" class="img-thumbnail mx-auto w-100 h-100 " alt="" style="max-width:100px;max-height:100px; "  />
                        </div>
                        <div class="col-8 col-lg-10">
                            <h3 style="font-size: large;"><a href="product.php?prodotto=<?php echo $prodotti[$i]["codice"]; ?>"><?php echo $prodotti[$i]["nomeFungo"]; ?></a></h2>
                                <p><strong><?php echo $prodotti[$i]["prezzoPerUnità"]; ?> €/Kg</strong></p>
                                <p><?php echo $prodotti[$i]["quantità"]; ?> in stock</p>
                        </div>
                    </article>
                </section>

            <?php endfor; ?>
        </div>
        <div class="col-12">
        
            <h3 class="text-center">Ricette:</h3>
            <?php $ricette = $dbh->getRicetteUtenteByUsername($user["username"]);
            $x = 0;
            if (count($ricette) < 3) {
                $x = count($ricette);
            } else {
                $x = 3;
            }
            for ($i = 0; $i < $x; $i++) : ?>
                <article class="row align-items-center bg-light border my-2">
                    <div class="col-4 col-lg-2 d-flex">
                        <img src="<?php echo UPLOAD_DIR . $ricette[$i]["img"]; ?>" class="img-thumbnail mx-auto w-100 h-100 " alt="" style="max-width:100px;max-height:100px; "  />
                    </div>
                    <div class="col-8 col-lg-10">
                        <h3 style="font-size: large;"><a href="paginaricetta.php?titoloRicetta=<?php echo $ricette[$i]["titolo"]; ?>"><?php echo $ricette[$i]["titolo"]; ?></a></h2>
                            <p><?php echo $ricette[$i]["descrizione"]; ?></p>
                    </div>
                </article>

            <?php endfor; ?>
            <!--sezione ricette-->
        </div>

    </div>
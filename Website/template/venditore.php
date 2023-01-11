<?php
$user = $templateParams["user"];
?>

<h1 class="text-center">Pagina Utente</h1>
<h2 class="text-center"><?php echo $user["username"] ?></h2>
<div class="container">
    <div class="row p-4 d-flex ">

        <div class="col-12 text-start border border-secondary rounded py-3 mb-4" id="info">
            <h2 class="text-center mb-4">Informazioni</h2>
            <p><strong>Nome:</strong> <?php echo $user["nome"] ?></p>
            <p><strong>Cognome:</strong> <?php echo $user["cognome"] ?></p>
            <p><strong>Email:</strong> <?php echo $user["email"] ?></p>
            <p><strong>Indirizzo:</strong> <?php echo $user["indirizzo"] ?></p>
            <p><strong>Data di nascita:</strong> <?php echo $user["data nascita"] ?></p>
            <p><strong>Kg di funghi venduti:</strong> <?php echo $user["funghiVendutiKg"] ?></p>
            <p><strong>Offerte inserite:</strong> <?php echo $user["offerteInserite"] ?></p>
            <p><strong>Media Valutazioni:</strong> <?php echo $user["mediaValutazioni"] ?></p>
            <p><strong>Info Venditore:</strong> <?php echo $user["info_venditore"] ?></p>
        </div>
        <div class="col-12 " id="prodotti">
            <h3 class="text-center">Prodotti in vendita</h3>
            <?php $prodotti = $dbh->getProdottiUtenteByUsername($user["username"]);
            $x = 0;
            if (count($prodotti) < 3) {
                $x = count($prodotti);
            } else {
                $x = 3;
            }
            for ($i = 0; $i < $x; $i++) : ?>
                <section class="px-3 border bg-light mb-2">
                    <article class="row align-items-center">
                        <div class="col-3 col-lg-2 d-flex justify-content-center  ">
                            <img src="<?php echo UPLOAD_DIR . $prodotti[$i]["img"]; ?>" class="img-thumbnail m-auto w-100 h-100 " alt="" />
                        </div>
                        <div class="col-9 col-lg-10">
                            <h5 class="mb-2 text-start"><a href="product.php?prodotto=<?php echo $prodotti[$i]["codice"]; ?>"><?php echo $prodotti[$i]["nomeFungo"]; ?></a></h5>
                            <p><?php echo substr($prodotti[$i]["informazioni"], 0, 45) . ".."; ?></p>
                            <div class="d-flex justify-content-between">
                                <?php if ($prodotti[$i]["quantità"] <= 0) : ?>
                                    <p class="text-danger">Non disponibile</p>
                                <?php else : ?>
                                    <p><?php echo $prodotti[$i]["quantità"]; ?> in stock</p>
                                <?php endif; ?>
                                <p><strong><?php echo $prodotti[$i]["prezzoPerUnità"]; ?> €/Kg</strong></p>
                            </div>
                        </div>
                    </article>
                </section>
            <?php endfor; ?>
            <div class="row">
                <div class="d-flex col-12">
                <a href="ricette.php?username=<?php echo $user["username"] ?>" type="button" class="ms-auto me-4 btn btn-info btn-sm ml-auto text-white">Vedi altro...</a> 
                </div>
            </div>
        </div>
        <div class="col-12 mt-3" id="ricette">
            <h3 class="text-center">Ricette</h3>
            <?php $ricette = $dbh->getRicetteUtenteByUsername($user["username"]);
            $x = 0;
            if(count($ricette)>0){
                if (count($ricette) < 3) {
                   $x = count($ricette);
                } else {
                    $x = 3;
                }
                for ($i = 0; $i < $x; $i++) : ?>
                    <section class="px-3 border bg-light mb-2">
                        <article class="row align-items-center">
                            <div class="col-3 col-lg-2 d-flex justify-content-center  ">
                                <img src="<?php echo UPLOAD_DIR . $ricette[$i]["img"]; ?>" class="img-thumbnail img-fluid m-auto w-100 h-100 " alt="" />
                            </div>
                            <div class="col-9 col-lg-10">
                                <h5><a href="paginaricetta.php?titoloRicetta=<?php echo $ricette[$i]["titolo"]; ?>"><?php echo $ricette[$i]["titolo"]; ?></a></h5>
                                <p><?php echo substr($ricette[$i]["descrizione"], 0, 100) . ".."; ?></p>
                            </div>
                        </article>

                <?php endfor; ?>
                </section>
                <div class="row">
                    <div class="d-flex col-12">
                        <a href="ricette.php?username=<?php echo $user["username"] ?>" type="button" class="ms-auto me-4 btn btn-info btn-sm ml-auto text-white">Vedi altro...</a> 
                    </div>
                </div>
            <?php
            }else if(count($ricette)==0): ?>
                <div class="row text-center">
                    <p>Questo utente non ha pubblicato alcuna ricetta.</p>
                </div>
            <?php endif;?>
        </div>

    </div>
</div>
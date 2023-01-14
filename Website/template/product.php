<?php $prodotto = $templateParams["prodotto"][0]; ?>
<?php $immagini = $templateParams["immagini"]; ?>
<?php $recensioni = $templateParams["recensioni"]; ?>
<?php $thisPage = "/tecnologieWeb2021---E-Commerce/Website/product.php?prodotto=" . $prodotto["codice"]; ?>

<!-- Funzione per aggiungere una recensione -->
<?php
if (isset($_POST["addReview"]) && isUserLoggedIn()) {
    $titolo = $_POST["titoloRecensione"];
    $contenuto = $_POST["contenutoRecensione"];
    $voto = $_POST["votoRecensione"];
    //$errorRecensione = false;
    $res = $dbh->addProductReview($titolo, $contenuto, $voto, $_SESSION["email"], $prodotto["codice"]);
    if ($res === "Recensione utente già presente") {
        $errorRecensione = 1;
    } else if ($res === "Recensione non consentita su proprio prodotto") {
        $errorRecensione = 2;
    } else if ($res === "Recensione non consentita su prodotto mai acquistato") {
        $errorRecensione = 3;
    } else {
        header("Location: " . $thisPage);
        unset($_POST["addReview"]);
    }
}
if (isset($_GET["toast"])) : ?>
    <script>
        $().ready(function() {
            toastr.success("Prodotto aggiunto al carrello");
        })
    </script>

<?php unset($_GET["toast"]);
endif; ?>
<!-- Funzione per eliminare una recensione -->
<?php if (isset($_POST["deleteReview"]) && isset($_POST["rev"]) && isUserLoggedIn()) {
    $dbh->deleteReviewById($_POST["rev"]);
    header("Location: " . $thisPage);
    unset($_POST["rev"]);
    unset($_POST["deleteReview"]);
} ?>

<div>
    <h1 class="p-2"><?php echo $prodotto["nomeFungo"]; ?></h1>
    <!-- Prodotto -->
    <article class="bg-light border p-2 m-2">
        <!-- Immagini -->
        <div class="col-12">
            <div class="row justify-content-center">
                <div class='col-10 col-md-8'>
                    <div id="carousel" class="carousel slide  carousel-fade" data-bs-ride="carousel" data-pause="hover">
                        <div class="carousel-indicators">
                            <?php if(count($immagini)>=1):?>
                            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <?php for($x = 0 ; $x<count($immagini)-1;$x++): ?>
                                <button type="button" data-bs-target="#carousel" data-bs-slide-to="<?php echo $x + 1?>"  aria-label="Slide <?php echo $x + 2?>"></button>
                            <?php endfor; 
                                endif;?>
                        </div>
                        <div class="carousel-inner d-flex align-items-center">
                            <?php foreach ($immagini as $img) : ?>
                                <div class="carousel-item <?php if ($img == $immagini[0]) {
                                                                echo "active";
                                                            } ?> d-flex justify-content-center  ">
                                    <img src="<?php echo UPLOAD_DIR . $img["nome"] ?>" class="m-auto img-fluid " alt="...">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev m-auto " type="button" data-bs-target="#carousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next m-auto" type="button" data-bs-target="#carousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dati prodotto -->
        <div class="row col-12 mt-2">
            <div class="col-12 col-md-10">
                <p>Venduto da: <a href="venditore.php?username=<?php echo $prodotto["username"] ?>"><strong><?php echo $prodotto["username"]; ?></strong></a></p>
                <div class="modal fade" id="modalInfoVenditore" tabindex="-1" aria-labelledby="modalInfoVenditoreLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="modalInfoVenditoreLabel">Info Venditore</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><?php echo $dbh->getUtente($prodotto["username"])[0]["info_venditore"] ?> </p>
                            </div>

                        </div>
                    </div>
                </div>
                <p>Prezzo: <strong><?php echo $prodotto["prezzoPerUnità"]; ?> €/Kg</strong></p>
                <p>Informazioni:<br><?php echo $prodotto["informazioni"]; ?></p>
                <button type="button" class="btn btn-outline-success btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#modalInfoVenditore">
                    Visualizza Info Venditore
                </button>

            </div>
                                                    </div>
            <!-- Add to cart button -->

            <div class="text-center col-6 col-md-2 mx-auto my-auto ">
                <?php if ($prodotto["quantità"] <= 0) : ?>
                    <p class="text-danger"> Prodotto non disponibile </p>
                <?php else : ?>
                    
                    <form method="post">
                        <label for="sel" class="my-1">Scegli quantità:</label>
                        <select class="form-control text-center my-1" id="sel" name="sel">
                            <?php
                            for ($i = 1; $i <= $prodotto["quantità"]; $i++) {
                                echo '<option>', $i, '</option>';
                            } ?>
                        </select>
                        <?php
                        if ((isUserLoggedIn() && $prodotto["offerente"] == $_SESSION["email"]) || (!isUserLoggedIn())) : ?>
                            <input disabled type="submit" value="Aggiungi al carrello" class="btn btn-warning my-1"/>
                            <?php if (!isUserLoggedIn()) : ?>
                            <p class="text-secondary">Devi essere loggato per poter aggiungere al carrello</p>
                            <?php endif; ?>
                        <?php else : ?>
                            <input type="submit" value="Aggiungi al carrello" class="btn btn-warning my-1"/>
                        <?php endif; ?>
                    </form>
                    <?php if (isUserLoggedIn() && $prodotto["offerente"] == $_SESSION["email"]) : ?>
                        <p class="text-danger text-left "> Non puoi aggiungere al carrello prodotti di cui sei il proprietario </p>
                    <?php endif; ?>


                <?php endif; ?>
                <script>
                    $("input[type=submit][value='Aggiungi al carrello']").click(function(event) {
                        event.preventDefault();
                        aggiungiAlCarrello();
                    })

                    function aggiungiAlCarrello() {
                        let codProd = new URLSearchParams(window.location.search).get("prodotto");
                        let qty = $("select[name='sel']").val();
                        $.ajax({
                            url: "api-prodotto.php",
                            data: {
                                "action": "aggiungiAlCarrello",
                                "codProd": codProd,
                                "qty": qty
                            },
                            type: "post",
                            cache: false,
                            success: function(response) {
                                if (response === "success") {
                                    window.location.href = "http://localhost/tecnologieWeb2021---E-Commerce/Website/product.php?prodotto=" + codProd + "&toast=true";
                                } else if (response === "max num raggiunto") {
                                    toastr.error("Quantità massima raggiunta per questo prodotto.");
                                } else {
                                    console.log(response);
                                    toastr.error("Errore nell'acquisto.");
                                }
                            }
                        });

                    }
                </script>

                <?php
                // if (isset($_POST["sel"])) {
                //     $quantità = $_POST["sel"];
                //     $dbh->addProductToCart($prodotto["codice"], $quantità);
                // }
                ?>
            </div>
    </article>

    <!-- Recensioni degli utenti -->
    <div class="col-12 col-md-8 mx-auto mt-4">
        <h2 class="text-center my-auto">Recensioni degli utenti</h2>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Nuova recensione</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <?php if (!isUserLoggedIn()) : ?>
                                <h4>Utente non loggato!</h4>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label for="titoloRecensione" class="col-form-label">Titolo recensione:</label>
                                <textarea class="form-control" id="titoloRecensione" name="titoloRecensione" <?php if (!isUserLoggedIn()) {
                                                                                                            echo "disabled";
                                                                                                         } ?>></textarea>
                            </div>
                            <div class="mb-3">
                            <label for="contenutoRecensione" class="col-form-label">Contenuto recensione:</label>
                                <textarea class="form-control" id="contenutoRecensione" name="contenutoRecensione" <?php if (!isUserLoggedIn()) {
                                                                                                                echo "disabled";
                                                                                                            } ?>></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="votoRecensione" class="col-form-label">Valutazione:</label>
                                <output>0</output><input class="form-range" oninput="this.previousElementSibling.value = parseFloat(this.value).toFixed(1)" id="votoRecensione" type="range" step="1" min="0" max="5" value="0" name="votoRecensione" <?php if (!isUserLoggedIn()) {
                                                                                                                                                                                                                                                                    echo " disabled";
                                                                                                                                                                                                                                                                } ?>>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                <input type="submit" name="addReview" value="Invia" class="btn btn-primary" <?php if (!isUserLoggedIn()) {
                                                                                                                echo "disabled";
                                                                                                            } ?>/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="col-12 mt-3">
                <?php if (empty($recensioni)) : ?>
                    <p class="text-center p-2">Non ci sono recensioni per questo prodotto.</p>
                <?php endif; ?>
                <div tabindex="0" class="divScrollabile">
                    <?php foreach ($recensioni as $recensione) : ?>
                        <article class="row col-12 bg-light card-body my-1 border-bottom">
                            <div class="col-4 col-lg-2">
                                <img src="img/profile.png" alt="" />
                            </div>
                            <div class="col-8 col-lg-10">
                                <p><strong><?php echo $recensione["titolo"]; ?></strong></p>
                                <p>by <strong><?php echo $recensione["username"]; ?></strong></p>
                                <?php for ($i = 0; $i < intval($recensione["valutazione"]); $i++) {
	                                echo '<span style="color:orange;" class="fa fa-star checked"></span>';
                                }?>
                                <p><?php echo $recensione["contenuto"]; ?></p>
                                <p><small class="text-muted"><?php echo $recensione["data"]; ?></small></p>
                            </div>
                            <?php if (isset($_SESSION["username"]) && $_SESSION["username"] == $recensione["username"]) : ?>
                                <div class="d-flex flex-column align-items-end">
                                    <form method="post">
                                        <input type="hidden" name="rev" value="<?php echo $recensione["codice"]; ?>"/>
                                        <input type="submit" name="deleteReview" value="Cancella" class="btn btn-warning"/>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </article>

                    <?php endforeach; ?>
                </div>
            </div>

        </div>
        <div class="text-center">
            <button type="button" class="btn btn-warning mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Aggiungi Recensione</button>
        </div>
        <?php
        if (isset($errorRecensione) && $errorRecensione === 1) : ?>
            <p class="text-danger text-center"> Recensione utente già presente</p>
        <?php elseif (isset($errorRecensione) && $errorRecensione === 2) : ?>
            <p class="text-danger text-center"> Non puoi recensire un tuo prodotto.</p>
        <?php elseif (isset($errorRecensione) && $errorRecensione === 3) : ?>
            <p class="text-danger text-center"> Non Puoi recensire prodotto mai acquistato</p>
        <?php
            unset($errorRecensione);
        endif; ?>
    </div>
    </div>
    
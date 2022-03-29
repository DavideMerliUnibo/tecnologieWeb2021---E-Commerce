<?php $prodotto = $templateParams["prodotto"][0]; ?>
<?php $immagini = $templateParams["immagini"]; ?>
<?php $recensioni = $templateParams["recensioni"]; ?>

<?php  
    if(isset($_POST["addReview"]) && isUserLoggedIn()){
        $titolo = $_POST["titoloRecensione"];
        $contenuto = $_POST["contenutoRecensione"];
        $voto = $_POST["votoRecensione"];
        $dbh->addProductReview($titolo, $contenuto, $voto, $_SESSION["email"], $prodotto["codice"]);
        header("Location: https://localhost/tecnologieWeb2021---E-Commerce/Website/product.php?prodotto=".$prodotto["codice"]);
        unset($_POST["addReview"]);
    }
?>

<?php if(isset($_POST["deleteReview"])){
    $dbh -> deleteReviews();
    header("Location: https://localhost/tecnologieWeb2021---E-Commerce/Website/product.php?prodotto=".$prodotto["codice"]);
}?>



<main>

    <!-- <?php $prodotto = $templateParams["prodotto"][0]; ?>
    <?php $immagini = $templateParams["immagini"]; ?>
    <?php $recensioni = $templateParams["recensioni"]; ?> -->

    <h1 class="p-2"><?php echo $prodotto["nomeFungo"]; ?></h1>
    <!-- Prodotto -->
    <article class="bg-light border p-2 m-2">

        <!-- Immagini -->
        <div class="col-12">
            <div class="row justify-content-center">
                <div id="carousel1" class="carousel slide col-10 " data-bs-ride="carousel" data-pause="hover">
                    <div class="carousel-inner">
                        <?php foreach($immagini as $img): ?>
                        <div class="carousel-item <?php if($img == $immagini[0]){ echo "active"; }?>">
                            <img src="img/<?php echo $img["nome"]; ?>" class="d-block m-auto " alt="...">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev m-auto" type="button" data-bs-target="#carousel1" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next m-auto" type="button" data-bs-target="#carousel1" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Dati prodotto -->
        <div class="row col-12">
            <div class="col-12 col-md-10">
                <p>Venduto da: <strong><?php echo $prodotto["username"]; ?></strong></p>
                <p>Prezzo: <strong><?php echo $prodotto["prezzoPerUnità"]; ?> €/Kg</strong></p>
                <p>Informazioni:</p>
                <p class="px-2"><?php echo $prodotto["informazioni"]; ?></p>
            </div>
            
            <!-- Add to cart button -->
            <div class="text-center col-6 col-md-2 mx-auto my-auto">
                <label for="sel" class="my-1">Scegli quantità:</label>
                <form method="post">
                    <select class="form-control text-center my-1" name="sel" style:="width: 50;">
                        <?php 
                            for($i=1;$i<=$prodotto["quantità"];$i++){
                                echo '<option>',$i,'</option>';
                            }?>
                    </select>
                    <input type="submit" name="quantity" value="Aggiungi al carrello"   class="btn btn-warning my-1"></input>
                </form>
                <?php  
                    if(isset($_POST["quantity"])){
                        $quantità=$_POST["sel"];
                        $dbh->addProductToCart($prodotto["codice"],$quantità,$_SESSION["email"]);
                    }
                    
                ?>
            </div>
    </article>

    <form method="post">
        <input type="submit" name="deleteReview" value="Cancella" class="btn btn-primary"></input>
    </form>
    

    <!-- Recensioni degli utenti -->
    <div class="col-12 col-md-8 mx-auto">
            <h2 class="text-center my-auto">Recensioni degli utenti</h2>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuova recensione</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <?php if (!isUserLoggedIn()):?>
                                <h3>Utente non loggato!</h3>
                                <?php endif; ?>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Titolo recensione:</label>
                                    <textarea class="form-control" id="message-text" name="titoloRecensione" <?php if(!isUserLoggedIn()){ echo "disabled"; }?>></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Contenuto recensione:</label>
                                    <textarea class="form-control" id="message-text" name="contenutoRecensione" <?php if(!isUserLoggedIn()){ echo "disabled"; }?>></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Valutazione:</label>
                                    <output>0</output><input required class="form-range" oninput="this.previousElementSibling.value = parseFloat(this.value).toFixed(1)" id="votoRecensione" type="range" step="1" min="0" max="5" value="0" name="votoRecensione" <?php if(!isUserLoggedIn()){ echo " disabled"; }?>>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                    <input type="submit" name="addReview" value="Invia" class="btn btn-primary" <?php if(!isUserLoggedIn()){ echo "disabled"; }?>></input>
                                </div>
                            </form>

                            

                        </div>
                        
                    </div>
                </div>
            </div>
            <div>
                <div class="col-12">
                    <?php if(empty($recensioni)): ?>
                        <p class="text-center p-2">Non ci sono recensioni per questo prodotto.</p>
                    <?php endif; ?>
                    <div tabindex="0" class="divScrollabile">
                        <?php foreach($recensioni as $recensione): ?>
                        <article class="row col-12 bg-light card-body my-1 border-bottom">
                            <div class="col-4 col-lg-2">
                                <img src="img/profile.png" alt="" height="100"/>
                            </div>
                            <div class="col-8 col-lg-10">
                                <p>by <strong><?php echo $recensione["username"]; ?></strong></p>
                                <p>Data: <?php echo $recensione["data"]; ?></p>
                                <p><?php echo $recensione["contenuto"]; ?></p>
                            </div>
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Aggiungi Recensione</button>
            </div>
        </div>
    </div>
</main>
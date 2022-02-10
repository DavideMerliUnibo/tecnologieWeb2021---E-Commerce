<main>
    

    <?php $prodotto = $templateParams["prodotto"][0]; ?>
    <?php $immagini = $templateParams["immagini"]; ?>
    <?php $recensioni = $templateParams["recensioni"]; ?>

    <h1 class="p-2"><?php echo $prodotto["nomeFungo"]; ?></h1>
    <!-- Prodotto -->
    <article class="bg-light border p-2 m-2">

        <!-- Immagini -->
        <div class="col-12">
            <div class="row justify-content-center">
                <div id="carousel1" class="carousel slide col-10 " data-bs-ride="carousel" data-pause="hover">
                    <div class="carousel-inner">
                        <?php foreach($immagini as $immagine): ?>
                        <div class="carousel-item <?php if($immagine == $immagini[0]){ echo "active"; }?>">
                            <img src="img/<?php echo $immagine["nome"]; ?>" class="d-block m-auto " alt="...">
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
        <p>Venduto da: <strong><?php echo $prodotto["username"]; ?></strong></p>
        <p>Prezzo: <strong><?php echo $prodotto["prezzoPerUnità"]; ?> €/Kg</strong></p>
        <p>Informazioni:</p>
        <p class="px-2"><?php echo $prodotto["informazioni"]; ?></p>
    </article>

    <!-- Recensioni degli utenti -->
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Recensioni degli utenti</h2>
                
                <div style="overflow-y: scroll;height: 400px;" tabindex="0" class="">
                    <?php if(empty($recensioni)): ?>
                    <p class="text-center p-2">Non ci sono recensioni per questo prodotto.</p>
                    <?php endif; ?>
                    <div class="text-center">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Aggiungi Recensione</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nuovo recensione</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Titolo recensione:</label>
                                        <textarea class="form-control" id="message-text"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Contenuto recensione:</label>
                                        <textarea class="form-control" id="message-text"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Valutazione:</label>
                                        <output>0</output><input required class="form-range" oninput="this.previousElementSibling.value = parseFloat(this.value).toFixed(1)" 
                                        id="difficolta" type="range" step="1" min="0" max="5" value="0" name="difficolta">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                <button type="button" class="btn btn-primary">Invia</button>
                            </div>
                        </div>
                  </div>
                </div>
                </div>
                    <?php foreach($recensioni as $recensione): ?>
                    <article class="row col-12 bg-light card-body my-1 border-bottom">
                        <div class="col-4 col-lg-2">
                            <img src="img/profile.png" alt="" height="100"/>
                        </div>
                        <div class="col-8 col-lg-10">
                            <h2 style="font-size: large;"><?php echo $recensione["titolo"]; ?></h2>
                            <p>by <strong><?php echo $recensione["username"]; ?></strong></p>
                            <p>Data: <?php echo $recensione["data"]; ?></p>
                            <p>Valutazione: <?php echo $recensione["valutazione"]; ?></p>
                            <p><?php echo $recensione["contenuto"]; ?></p>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>
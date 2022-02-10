<?php $ricetta = $templateParams["titoloRicetta"][0]; ?>
<?php $tabella = $templateParams["tabella"][0]; ?>
<?php $immagini = $templateParams["immaginiRicetta"]; ?>
<?php $commenti = $templateParams["commenti"]; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center my-3"><?php echo $ricetta["titolo"]; ?></h1>
        </div>
        <div class="col-12">
            <div class="row justify-content-center">
                <div id="carousel1" class="carousel slide col-10 " data-bs-ride="carousel" data-pause="hover">
                    <div class="carousel-inner">
                        <?php foreach($immagini as $img): ?>
                        <div class="carousel-item <?php if ($img == $immagini[0]) { echo "active"; } ?>">
                            <img src="img/<?php echo $img["nome"]; ?>" class="d-block m-auto " alt="...">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev m-auto" type="button" data-bs-target="#carousel1" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next m-auto" type="button" data-bs-target="#carousel1"
                    data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="row m-3 justify-content-around align-items-center d-md-none" id="calories">
                                <h5 class="m-0 col-9">Calorie</h5>
                                <div class="col-3 d-flex justify-content-end"><button type="button" data-bs-toggle="collapse" data-bs-target="#calInfo" aria-expanded="false" aria-controls="calInfo" class="btn btn-primary p-0 my-2">info+</button>
                                </div>
                                <div class="collapse" id="calInfo">
                                    <div class="card card-body mb-2">
                                        <table class="table table-success table-striped">
                                            <tr>
                                                <th>Valore energetico</th>
                                                <td><?php echo $tabella["valoreEnergetico"]; ?> Kcal</td>
                                            </tr>
                                            <tr>
                                                <th>Proteine</th>
                                                <td><?php echo $tabella["proteine"]; ?> g</td>
                                            </tr>
                                            <tr>
                                                <th>Carboidrati</th>
                                                <td><?php echo $tabella["carboidrati"]; ?> g</td>
                                            </tr>
                                            <tr>
                                                <th>Grassi</th>
                                                <td><?php echo $tabella["grassi"]; ?> g</td>
                                            </tr>
                                            <tr>
                                                <th>Fibre</th>
                                            <td><?php echo $tabella["fibre"]; ?> g</td>
                                                </tr>
                                            <tr>
                                                <th>Sodio</th>
                                                <td><?php echo $tabella["sodio"]; ?> g</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <h2 class="text-center">Ingredienti</h2>
                            <ul class="list-group">
                                <?php foreach($templateParams["ingredienti"] as $ingrediente): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo $ingrediente["nome"]; ?>
                                    <span class="badge bg-primary rounded-pill"><?php echo $ingrediente["quantità"]; ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <h2 class="text-center">Preparazione</h2>
                    <p class="text-justify"><?php echo $ricetta["procedimento"]; ?></p>
                    <h2 class="text-center">Consigli</h2>
                    <p class="text-justify"><?php echo $ricetta["consigli"]; ?></p>
                </div>
            </div>
        </div>
        <div class="col-12 float-md-start col-md-3 mx-auto">
            <h2 class="text-center">Altre ricette</h2>
            <div class="row flex-nowrap flex-md-wrap text-center g-2 mt-1" id="altreRicetteContainer">
                <div class="col-3 col-md-12 mt-1 justify-content-around">
                    <div class="card card-body">
                        <a href="#">altra ricetta</a>
                        <p class="card-text">buona assai</p>
                    </div>
                </div>
               
                <div class="col-3 col-md-12 mt-1 justify-content-around">
                    <div class="card card-body">
                        <a href="#">altra ricetta</a>
                        <p class="card-text">buona assai</p>
                    </div>
                </div>
                <div class="col-3 col-md-12 mt-1 justify-content-around">
                    <div class="card card-body">
                        <a href="#">altra ricetta</a>
                        <p class="card-text">buona assai</p>
                    </div>
                </div>
                      
            </div>
        </div> 

        <!-- Commenti -->
        <div class="col-12 col-md-8 mx-auto">
            <h2 class="text-center my-auto">Commenti</h2>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuovo commento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Titolo commento:</label>
                                    <textarea class="form-control" id="message-text"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Contenuto commento:</label>
                                    <textarea class="form-control" id="message-text"></textarea>
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
            <div class="row">
                <div class="col-12">
                    <?php if(empty($commento)): ?>
                        <p class="text-center p-2">Non ci sono commenti per questa ricetta.</p>
                    <?php endif; ?>
                    <div tabindex="0" class="divScrollabile">
                        <?php foreach($commenti as $commento): ?>
                        <article class="row col-12 bg-light card-body my-1 border-bottom">
                            <div class="col-4 col-lg-2">
                                <img src="img/profile.png" alt="" height="100"/>
                            </div>
                            <div class="col-8 col-lg-10">
                                <p>by <strong><?php echo $commento["username"]; ?></strong></p>
                                <p>Data: <?php echo $commento["data"]; ?></p>
                                <p><?php echo $commento["contenuto"]; ?></p>
                            </div>
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Aggiungi Commento</button>
            </div>
        </div>
    </div>
</div>
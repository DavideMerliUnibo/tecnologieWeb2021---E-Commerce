<?php $ricetta = $templateParams["titoloRicetta"][0]; ?>
<?php $tabella = $templateParams["tabella"][0]; ?>
<?php $immagini = $templateParams["immaginiRicetta"]; ?>
<?php $commenti = $templateParams["commenti"]; ?>
<?php $thisPage = "http://localhost/tecnologieWeb2021---E-Commerce/Website/paginaricetta.php?titoloRicetta=" . $ricetta["titolo"]; ?>

<!-- Funzione per aggiungere un commento -->
<?php
if (isset($_POST["addComment"]) && isUserLoggedIn()) {
    $contenuto = $_POST["contenutoCommento"];
    $res = $dbh->addRecipeComment($contenuto, $_SESSION["email"], $ricetta["titolo"]);
    if ($res === "Commento utente già presente") {
        $errorCommento = 1;
    } else if ($res === "Commento non consentito su propria ricetta") {
        $errorCommento = 2;
    } else {
        header("Location: " . $thisPage);
        unset($_POST["addComment"]);
    }
}
?>
<!-- Funzione per eliminare un commento -->
<?php if (isset($_POST["deleteComment"])) {
    $dbh->deleteCommentById($_POST["com"]);
    header("Location: " . $thisPage);
    unset($_POST["com"]);
    unset($_POST["deleteComment"]);
} ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center my-3"><?php echo $ricetta["titolo"]; ?></h1>
        </div>
        <div class="col-12">
            <div class="row justify-content-center">
                <div id="carousel1" class="carousel slide col-10 " data-bs-ride="carousel" data-pause="hover">
                    <div class="carousel-inner">
                        <?php foreach ($immagini as $img) : ?>
                            <div class="carousel-item <?php if ($img == $immagini[0]) {
                                                            echo "active";
                                                        } ?>">
                                <img src="<?php echo UPLOAD_DIR . $img["nome"]; ?>" class="d-block m-auto img-fluid" alt="...">
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

        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="row m-3 justify-content-around align-items-center" id="calories">
                                <h2 class="m-0 col-9">Calorie</h2>
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
                                <?php foreach ($templateParams["ingredienti"] as $ingrediente) : ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo $ingrediente["nome"]; ?>
                                        <span class="badge bg-primary rounded-pill"><?php echo $ingrediente["quantità"]; ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <h3 class="text-center">Preparazione</h3>
                    <p class="text-justify"><?php echo $ricetta["procedimento"]; ?></p>
                    <h3 class="text-center">Consigli</h3>
                    <p class="text-justify"><?php echo $ricetta["consigli"]; ?></p>
                    <!-- Commenti -->
                    <h3 class="text-center my-auto">Commenti</h3>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">Nuovo commento</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <?php if (!isUserLoggedIn()) : ?>
                                            <h3>Utente non loggato!</h3>
                                        <?php endif; ?>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">Contenuto commento:</label>
                                            <textarea class="form-control" id="message-text" name="contenutoCommento" <?php if (!isUserLoggedIn()) {
                                                                                                                            echo "disabled";
                                                                                                                        } ?>></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                            <input type="submit" name="addComment" value="Invia" class="btn btn-primary" <?php if (!isUserLoggedIn()) {
                                                                                                                                echo "disabled";
                                                                                                                            } ?>></input>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?php if (empty($commenti)) : ?>
                                <p class="text-center p-2">Non ci sono commenti per questa ricetta.</p>
                            <?php endif; ?>
                        <div tabindex="0" class="divScrollabile">
                                <?php foreach ($commenti as $commento) : ?>
                                    <article class="row col-12 bg-light card-body my-1 border-bottom">
                                        <div class="col-4 col-lg-2">
                                            <img src="img/profile.png" alt=""  />
                                        </div>
                                        <div class="col-8 col-lg-10">
                                            <p>by <strong><?php echo $commento["username"]; ?></strong></p>
                                            <p><?php echo $commento["contenuto"]; ?></p>
                                            <p><small class="text-muted"><?php echo $commento["data"]; ?></small></p>
                                        </div>
                                        <?php if (isset($_SESSION["username"]) && $_SESSION["username"] == $commento["username"]) : ?>
                                            <div class="d-flex flex-column align-items-end">
                                                <form method="post">
                                                    <input type="hidden" name="com" value="<?php echo $commento["codice"]; ?>"></input>
                                                    <input type="submit" name="deleteComment" value="Cancella" class="btn btn-warning"></input>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                    </article>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-warning my-4" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Aggiungi Commento</button>
                    </div>
                    <?php if (isset($errorCommento) && $errorCommento === 1) : ?>
                        <p class="text-danger text-center"> Commento utente già presente </p>
                    <?php elseif (isset($errorCommento) && $errorCommento === 2) : ?>
                        <p class="text-danger text-center"> Non puoi commentare una tua ricetta </p>
                    <?php
                        unset($errorCommento);
                    endif; ?>
                </div>
            </div>
        </div>

        <div class="container py-2 px-5">
            <h2 class="text-center">Altre ricette</h2>
            <div class="row text-center">
                <?php
                $ricette = $dbh->getLatestRecipes(3);
                foreach ($ricette as $ricetta) : ?>
                <div class="col-4">
                    <div class="card bg-light ">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-4 my-2">
                                <a href="/tecnologieWeb2021---E-Commerce/Website/paginaricetta.php?titoloRicetta=<?php echo $ricetta["titolo"] ?>"><img class="img-thumbnail col-12 col-md-3" src="<?php echo UPLOAD_DIR . $ricetta['immagine'] ?>" alt="immagine che illusrtra la ricetta" style="width:5rem" /></a>
                            </div>
                            <div class="col-12 col-md-8">
                                <a class="text-dark col-12 col-md-9 align-self-center" style="text-decoration:none;" href="/tecnologieWeb2021---E-Commerce/Website/paginaricetta.php?titoloRicetta=<?php echo $ricetta["titolo"] ?>"><?php echo $ricetta["titolo"] ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
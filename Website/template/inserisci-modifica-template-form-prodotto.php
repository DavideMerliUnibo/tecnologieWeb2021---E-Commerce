<?php require_once "../bootstrap.php" ?>
<div class="row p-4">
    <div class="col">
        <div class="card fs-4">
            <div class="card-body">
                <form method="POST" action="#" id="formGestioneProdotti">
                    <div class="row text-start">
                        <div class="col-12 mb-2">
                            <label class="form-label" for="nomeFungo">Nome Fungo</label>

                            <select class="form-select" id="nomeFungo" name="nomeFungo">
                                <?php foreach ($dbh->getNomiScientificiFunghi() as $nome) : ?>
                                    <option value="<?php echo $nome["nomeScientifico"] ?>"> <?php echo  $nome["nomeScientifico"] ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-12 mb-2">
                            <label class="form-label" for="descrizione">Descrizione</label>
                            <textarea required class="form-control form-control-sm" rows="2" id="descrizione" name="descrizione"></textarea>
                        </div>

                        <div class="col-12 mb-2 ">
                            <label class="form-label " for="quantità">Quantità </label>
                            <div>
                                <input class='w-50' oninput="this.nextElementSibling.value = this.value" required type="range" class="form-range" min="0" max="100" id="quantità" name="quantità" />
                                <output>50</output>
                            </div>
                        </div>
                        <div class="col-12 mb-2 ">
                            <label class="form-label " for="prezzoUnità">Prezzo Unità </label>
                            <div>
                                <input class='w-50 ' oninput="this.nextElementSibling.value = this.value" required type="range" class="form-range" step="0.01" min="0" max="100" id="prezzoUnità" name="prezzoUnità" />
                                <output>50</output>
                            </div>
                        </div>
                        <div class="col-12 mb-2 ">
                            <div class="d-none">>
                                <input type="number" id="idProdotto" name="idProdotto" value=""/>
                            </div>
                        </div>
                    

                       

                        <!-- continuare -->
                    </div>
                    <div class="col-12 mt-1">
                        <input class="btn btn-success" type="submit" name="submitProdotto" value="Inserisci" onclick="">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
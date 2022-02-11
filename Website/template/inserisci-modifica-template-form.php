<div class="row p-4">
    <div class="col">
        <div class="card fs-4">
            <div class="card-body">
                <form method="POST" action="#" id="formProva">
                    <div class="row text-start">
                        <div class="col-12 mb-2">
                            <label class="form-label" for="titolo">Titolo</label><input required class="form-control form-control-sm" id="titolo" type="text" name="titolo">
                        </div>
                        <div class="col-12 mb-2">
                            <label class="form-label" for="difficolta">Difficoltà</label>
                            <output>0.0</output><input required class="form-range" oninput="this.previousElementSibling.value = parseFloat(this.value).toFixed(1)" id="difficolta" type="range" step="0.1" min="0.0" max="5.0" value="0.0" name="difficoltà">
                        </div>
                        <div class="col-12 mb-2">
                            <label class="form-label" for="descrizione">Descizione</label><textarea required class="form-control form-control-sm" rows="2" id="descrizione" name="descrizione"></textarea>
                        </div>
                        <div class="col-12 mb-2">
                            <label class="form-label" for="procedimento">Procedimento</label><textarea required class="form-control form-control-sm" id="procedimento" name="procedimento" rows="5"></textarea>
                        </div>
                        <div class="col-12 mb-2">
                            <label class="form-label" for="consigli">Consigli</label><textarea required class="form-control form-control-sm" id="consigli" name="consigli" rows="2"></textarea>
                        </div>
                        <div class="col-12 mb-2 ">
                            <fieldset class="border border-secondary rounded p-2">
                                <legend class="text-center">Tabella nutrizionale (per 100g)</legend>
                                <div class="row justify-content-between text-center">
                                    <div class="col-md-4 col-12">
                                        <label class="form-label" for="valoreEnergetico">ValoreEnergetico<br>(kcal)</label><input required class="form-control form-control-sm" id="valoreEnergetico" type="number" max="5000" min="0" name="valoreEnergetico">
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="form-label" for="proteine">Proteine<br>(g)</label><input required class="form-control form-control-sm" id="proteine" type="number" max="500" min="0" name="proteine">
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="form-label" for="grassi">Grassi<br>(g)</label><input required class="form-control form-control-sm" id="grassi" type="number" max="500" min="0" name="grassi">
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="form-label" for="carboidrati">Carboidrati<br>(g)</label><input required class="form-control form-control-sm" id="carboidrati" type="number" max="500" min="0" name="carboidrati">
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="form-label" for="fibre">Fibre<br>(g)</label><input required class="form-control form-control-sm" id="fibre" type="number" max="500" min="0" name="fibre">
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label class="form-label" for="sodio">Sodio<br>(g)</label><input required class="form-control form-control-sm" id="sodio" type="number" max="500" min="0" name="sodio">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-12 mt-1">
                        <input class="btn btn-secondary" type="submit" name="submitRicetta" value="Inserisci" onclick="return inserisciRicetta();">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
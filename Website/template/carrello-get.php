<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-3">Carrello</h1>
                <ol class="list-group  list-group-numbered">
                    <?php $totale=0; 
                    foreach($templateParams["prodottiCarrello"] as $prodotto):?>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold"><?php echo $prodotto["nomeFungo"] ; ?></div>
                            <div class="fw-italic mt-1">info</div>
                        </div>
                        <div class="ms-auto d-flex flex-column">
                            <span class="badge bg-primary rounded-pill ms-auto me-2">
                            <?php $totale=$totale+$prodotto["nomeFungo"]* $prodotto["quantità"];
                            echo $prodotto["nomeFungo"]* $prodotto["quantità"]; ?>
                            </span>                         
                            <label class="w-50 ms-auto me-0 justify-content-end d-flex align-items-center">
                                <?php echo $prodotto["quantità"] ; ?><input type="number" class="w-50 mt-2"></label>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ol>
                <div class="col-12 mt-3 d-flex justify-content-around align-items-center">
                    <h3 class="ms-2 fst-italic fw-bold">Totale</h3>
                    <p class=" fw-bold fs-1 text-primary"></p>
                </div>
            </div>
        </div>
    </div>
    <hr class="mb-4">
                <h4 class="mb-3">Payment</h4>
                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                        <label class="custom-control-label" for="credit">Carta di credito</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
                        <label class="custom-control-label" for="debit">Carta di debito</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                        <label class="custom-control-label" for="paypal">PayPal</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">Nome sulla carta</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                        <small class="text-muted">Nome completo come scritto sulla carta</small>
                        <div class="invalid-feedback">Inserire il nome è necessario </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Numero della carta</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                        <div class="invalid-feedback"> Inserire il numero è necessario </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Scadenza</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                        <div class="invalid-feedback"> Inserire la scadenza è necessario</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-cvv">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                        <div class="invalid-feedback"> Inserire il codice di sicurezza è necessario </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-dark">Checkout</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
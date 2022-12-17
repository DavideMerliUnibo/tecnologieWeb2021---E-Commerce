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
                            <div class="fw-bold"><a href="/tecnologieWeb2021---E-Commerce/Website/product.php?prodotto=<?php echo $prodotto["codice"]?>" class="text-dark"><?php echo $prodotto["nomeFungo"] ; ?></a></div>
                            <div class="fw-italic mt-1">quantità</div>
                        </div>
                        <div class="ms-auto d-flex flex-column">
                            <span class="badge bg-primary rounded-pill ms-auto me-2">
                            <?php $totale=$totale+ $prodotto["quantità"]*$prodotto["prezzoPerUnità"];
                            echo $prodotto["prezzoPerUnità"], " €/Kg ";
                             ?>
                            </span>                         
                            <p class="w-50 ms-auto me-0 justify-content-end d-flex align-items-center">
                                <input type="number" class="w-50 mt-2" value="<?php echo $prodotto["quantità"]; ?>"></input>
                            </p>
                        </div>

                        <!-- Delete button -->
                        <?php 
                            if(isset($_POST["delete".$prodotto["codice"]])){
                                $dbh -> removeProductfromCart($prodotto["codice"], $_SESSION["email"]);
                                echo '<script> location.reload(); </script>';
                            }
                        ?>
                        <form method="post" class="px-2">
                            <button type="submit" name="delete<?php echo $prodotto["codice"]; ?>" class="btn"><img src="img/trash.svg" alt="trash bin"/></button>
                        </form>
                    </li>
                    <?php endforeach; ?>
                </ol>
                <div class="col-12 mt-3 d-flex justify-content-around align-items-center">
                    <h3 class="ms-2 fst-italic fw-bold">Totale: <?php echo $totale; ?> €</h3>
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
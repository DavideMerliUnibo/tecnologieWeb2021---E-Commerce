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
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-dark">Checkout</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
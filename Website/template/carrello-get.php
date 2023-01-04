<?php if (isset($templateParams["toast"])) {
    switch ($templateParams["toast"]) {
        case "success":
            echo '<script type="text/javascript">toastr.success("Acquisto completato!");</script>';
            $dbh -> insertNotifica("Acquisto completato!", $_SESSION["email"]);
            break;
        case "error":
            echo '<script type="text/javascript">toastr.error("Errore nell\'acquisto!");</script>';
            $dbh -> insertNotifica("Errore nell'acquisto!", $_SESSION["email"]);
            break;
    }
    unset($templateParams["toast"]);
} ?>

<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-3">Carrello</h1>
            <ol class="list-group  list-group-numbered">
                <?php $totale = 0;
                foreach ($templateParams["prodottiCarrello"] as $prodotto) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold"><a href="/tecnologieWeb2021---E-Commerce/Website/product.php?prodotto=<?php echo $prodotto["codice"] ?>" class="text-dark"><?php echo $prodotto["nomeFungo"]; ?></a></div>
                            <div class="fw-italic mt-1">quantità</div>
                        </div>
                        <div class="ms-auto d-flex flex-column">
                            <span class="badge bg-primary rounded-pill ms-auto me-2">
                                <?php $totale = $totale + $prodotto["quantità"] * $prodotto["prezzoPerUnità"];
                                echo $prodotto["prezzoPerUnità"], " €/Kg ";
                                ?>
                            </span>
                            <?php if (!$dbh->checkDisponibilitàProdottoCarrello($prodotto["codice"])) : ?>
                                <p class=" ms-auto me-0 justify-content-end d-flex align-items-center text-danger">
                                    Non disponibile
                                </p>
                            <?php else : ?>
                                <p class="w-50 ms-auto me-0 justify-content-end d-flex align-items-center">
                                    <?php $max = $dbh->getProductById($prodotto['codice'])[0]['quantità'] ?>
                                    <input pattern="[0-9]{2}" type="number" max="<?php echo $max; ?>" class="w-50 mt-2 form-control" onchange="onchangeFunction(event,<?php echo $prodotto['codice']; ?>);" value="<?php echo $prodotto["quantità"]; ?>"></input>
                                </p>
                            <?php endif ?>

                        </div>

                        <!-- Delete button -->
                        <?php
                        if (isset($_POST["delete" . $prodotto["codice"]])) {
                            $dbh->removeProductfromCart($prodotto["codice"], $_SESSION["email"]);
                            echo '<script> location.reload(); </script>';
                        }
                        ?>
                        <form method="post" class="px-2">
                            <button type="submit" name="delete<?php echo $prodotto["codice"]; ?>" class="btn"><img src="img/trash.svg" alt="trash bin" /></button>
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
<form action="#" method="post">
    <h4 class="mb-3">Payment</h4>
    <div class="custom-control custom-radio">
        <div class="row">
            <div class="col-12">
                <input id="credit" name="metodoPagamento" type="radio" class="custom-control-input" checked="" required="" value="cartaCredito">
                <label class="custom-control-label" for="credit">Carta di credito</label>
            </div>
            <div class="col-12">
                <input id="debit" name="metodoPagamento" type="radio" class="custom-control-input" required="" value="cartaDebito">
                <label class="custom-control-label" for="debit">Carta di debito</label>
            </div>
            <div class="col-12">
                <input id="paypal" name="metodoPagamento" type="radio" class="custom-control-input" required="" value="paypal">
                <label class="custom-control-label" for="paypal">PayPal</label>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="cc-name">Nome sulla carta</label>
        <input type="text" class="form-control" id="cc-name" placeholder="" required="" name="nomeCarta">
        <small class="text-muted">Nome completo come scritto sulla carta</small>
        <div class="invalid-feedback">Inserire il nome è necessario </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="cc-number">Numero della carta</label>
        <input type="text" class="form-control" id="cc-number" placeholder="" required="" name="numeroCarta">
        <div class="invalid-feedback"> Inserire il numero è necessario </div>
    </div>

    <div class="col-md-3 mb-3">
        <label for="cc-expiration">Scadenza</label>
        <input type="text" class="form-control" id="cc-expiration" placeholder="" required="" name="scadenzaCarta">
        <div class="invalid-feedback"> Inserire la scadenza è necessario</div>
    </div>
    <div class="col-md-3 mb-3">
        <label for="cc-cvv">CVV</label>
        <input type="text" class="form-control" id="cc-cvv" placeholder="" required="" name="ccvCarta">
        <div class="invalid-feedback"> Inserire il codice di sicurezza è necessario </div>
    </div>

    <div class="col-12 d-flex justify-content-center">
        <button id="add" type="submit" class="btn btn-dark">Checkout</button>
    </div>

</form>

<script>
    $().ready(function() {
        $("input[type='number']").keypress(function(event) {
            event.preventDefault();
        });
    });

    function onchangeFunction(event, codProd) {
        let elem = $("input[type='number']");
        let num = elem.val();
        if (num <= 0) {
            elem.val(1);
        }
        num = elem.val();
        $.ajax({
            url: "api-prodotto.php",
            data: {
                "action": "aggiornaCarrelloQty",
                "codProd": codProd,
                "qty": num
            },
            cache: false,
            type: "post",
            success : function (result){
                console.log(result);
                if(result === "failure"){
                    toastr.error("Qualcosa è andato storto");
                }
            }
        });
    }
</script>
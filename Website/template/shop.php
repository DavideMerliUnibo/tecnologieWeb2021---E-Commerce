<h1 class="px-5">Shop</h1>

<div class="container py-2">
    <div class="row text-center g-2">
        <?php foreach ($templateParams["prodotti"] as $prodotto) : ?>
        <div class="col-12 col-md-3">
            <div class="card bg-light my-2">
                <div class="row">
                    <div class="col-6 col-md-12 mx-auto d-flex">
                        <a href="product.php?prodotto=<?php echo $prodotto["codice"]; ?>">
                            <img src="<?php echo UPLOAD_DIR . $prodotto["img"] ?>" class="img-fluid rounded-left mx-auto" alt="...">
                        </a>
                    </div>
                    <div class="col-6 col-md-12">
                        <div class="card-body">
                            <h5 class="card-title"><a href="product.php?prodotto=<?php echo $prodotto["codice"]; ?>"><?php echo $prodotto["nomeFungo"]; ?></a></h5>
                            <p>venduto da <strong><?php echo $prodotto["username"]; ?></strong></p>
                            <p><strong><?php echo $prodotto["prezzoPerUnità"]; ?> €/Kg</strong></p>
                            <?php if ($prodotto["quantità"] <= 0) : ?>
                                <p class="text-danger"> Non disponibile </p>
                            <?php else : ?>
                                <p><?php echo $prodotto["quantità"]; ?> in stock</p>
                            <?php endif; ?>
                            <p class="card-text"><small class="text-muted"><?php echo $prodotto["data"]; ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
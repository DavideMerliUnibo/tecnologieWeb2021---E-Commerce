<header>
    <h1 class="px-5">Shop</h1>
</header>
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
                        <div class="card-body pt-1 ">
                            <p class="card-title  cut-text"><a href="product.php?prodotto=<?php echo $prodotto["codice"]; ?>" alt=""><?php echo $prodotto["nomeFungo"]; ?></a></p>
                            
                            <p class="card-text">
                                <?php if ($prodotto["quantità"] <= 0) : ?>
                                     <span class="text-danger fs-7">Not available</span></br>
                                <?php else : ?>
                                    <?php echo $prodotto["quantità"]; ?> in stock </br>
                                <?php endif; ?>
                                <span class="d-none d-md-block">Venduto da </span><strong class='cut-text'><?php echo $prodotto["username"]; ?></strong></br>
                                <strong><?php echo $prodotto["prezzoPerUnità"]; ?> €/Kg</strong></br>
                                <small class="text-muted d-none d-sm-block"><?php echo $prodotto["data"]; ?></small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
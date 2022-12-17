<h1 class="px-5">Shop</h1>

<div class="row p-3">
    <?php foreach($templateParams["prodotti"] as $prodotto): ?>
    <div class="card my-1 col-12 col-md-3 px-0" >
        <div class="row">
                <div class="col-6 col-md-12 mx-auto d-flex">
                <img src="./img/<?php echo $prodotto["img"]; ?>" class="img-fluid rounded-left mx-auto"   alt="...">
            </div>
            <div class="col-6 col-md-12">
            <div class="card-body">
                <h5 class="card-title"><a href="product.php?prodotto=<?php echo $prodotto["codice"]; ?>"><?php echo $prodotto["nomeFungo"]; ?></a></h5>
                <p>venduto da <strong><?php echo $prodotto["username"]; ?></strong></p>
                <p><strong><?php echo $prodotto["prezzoPerUnità"]; ?> €/Kg</strong></p>
                <p><?php echo $prodotto["quantità"]; ?> in stock</p>
                <p class="card-text"><small class="text-muted"><?php echo $prodotto["data"]; ?></small></p>
            </div>
        </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
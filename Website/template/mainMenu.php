<div class="jumbotron jumbotron-fluid py-5 my-0" style="background: url('./img/homeImg.jpg') no-repeat center; background-size: cover;">
    <div class="container-fluid text-center py-5"> 
        <h1 class="px-3 text-white py-4">Benvenuto
        <?php if(isUserLoggedIn()){
            echo $_SESSION["username"];
        }?>
        </h1>
       <p><a href="login.php" class="btn bg-transparent text-white border-white" role="button">Accedi all'area personale</a></p>
    </div>
</div>

<!-- Sezione ultimi arrivi -->
<section class="p-3">
    <h2>Gli ultimi arrivi</h2>
    <?php foreach($templateParams["nuoviProdotti"] as $prodotto): ?>
    <article class="row align-items-center bg-light border my-2">
        <div class="col-4 col-lg-2">
            <img src="<?php echo UPLOAD_DIR.$prodotto["img"];?>" class="img-fluid" alt=""/>
        </div>
        <div class="col-8 col-lg-10">
            <h3 style="font-size: large;"><a href="product.php?prodotto=<?php echo $prodotto["codice"]; ?>"><?php echo $prodotto["nomeFungo"]; ?></a></h3>
            <p>venduto da <strong><?php echo $prodotto["username"]; ?></strong></p>
            <p><strong><?php echo $prodotto["prezzoPerUnità"]; ?> €/Kg</strong></p>
            <p><?php echo $prodotto["quantità"]; ?> in stock</p>
        </div>
    </article>
    <?php endforeach; ?>
</section>
<div class="d-flex flex-column align-items-end">
    <a href="shop.php"  class="btn btn-warning my-1 mx-1">Vai al negozio</a>
</div>

<!-- Sezione ultime ricette -->
<section class="p-3">
    <h2>Le novità in cucina</h2>
    <?php foreach($templateParams["nuoveRicette"] as $ricetta): ?>
    <article class="row align-items-center bg-light border my-2">
        <div class="col-4 col-lg-2">
            <img src="<?php echo UPLOAD_DIR.$ricetta["immagine"]; ?>" class="img-fluid" alt=""/>
        </div>
        <div class="col-8 col-lg-10">
            <h3 style="font-size: large;"><a href="paginaricetta.php?titoloRicetta=<?php echo str_replace(" ","%20",$ricetta["titolo"]); ?>"><?php echo $ricetta["titolo"]; ?></a></h3>
            <p>di <strong><?php echo $ricetta["autore"]; ?></strong></p>
            <p><?php echo $ricetta["descrizione"]; ?></p>
        </div>
    </article>
    <?php endforeach; ?>
</section>
<div class="d-flex flex-column align-items-end">
    <a href="ricette.php" class="btn btn-warning my-1 mx-1">Vedi tutte</a>
</div>
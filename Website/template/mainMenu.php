<h1 class="px-3">Benvenuto
    <?php if(isUserLoggedIn()){
        echo $_SESSION["username"];
    }?>
</h1>

<!-- Sezione accesso a pagina utente -->
<section class="p-3">
    <div class="text-center">
        <a href="login.php" type="button" class="btn btn-warning my-1">Accedi all'area personale</a>
    </div>
</setion>

<!-- Sezione ultimi arrivi -->
<section class="p-3">
    <h2>Gli ultimi arrivi</h2>
    <?php foreach($templateParams["nuoviProdotti"] as $prodotto): ?>
    <article class="row align-items-center bg-light border my-2">
        <div class="col-4 col-lg-2">
            <img src="./img/<?php echo $prodotto["img"]; ?>" alt="" height="100"/>
        </div>
        <div class="col-8 col-lg-10">
            <h3 style="font-size: large;"><a href="product.php?prodotto=<?php echo $prodotto["codice"]; ?>"><?php echo $prodotto["nomeFungo"]; ?></a></h2>
            <p>venduto da <strong><?php echo $prodotto["username"]; ?></strong></p>
            <p><strong><?php echo $prodotto["prezzoPerUnità"]; ?> €/Kg</strong></p>
            <p><?php echo $prodotto["quantità"]; ?> in stock</p>
        </div>
    </article>
    <?php endforeach; ?>
</section>
<div class="d-flex flex-column align-items-end">
    <a href="shop.php" type="button" class="btn btn-warning my-1">Vai al negozio</a>
</div>

<!-- Sezione ultime ricette -->
<section class="p-3">
    <h2>Le ultime novità in cucina</h2>
    <?php foreach($templateParams["nuoveRicette"] as $ricetta): ?>
    <article class="row align-items-center bg-light border my-2">
        <div class="col-4 col-lg-2">
            <img src="./img/<?php echo $ricetta["immagine"]; ?>" alt="" height="100"/>
        </div>
        <div class="col-8 col-lg-10">
            <h3 style="font-size: large;"><a href="product.php?ricetta=<?php echo $ricetta["titolo"]; ?>"><?php echo $ricetta["titolo"]; ?></a></h2>
            <p>di <strong><?php echo $ricetta["autore"]; ?></strong></p>
            <p><?php echo $ricetta["descrizione"]; ?></p>
        </div>
    </article>
    <?php endforeach; ?>
</section>
<div class="d-flex flex-column align-items-end">
    <a href="ricette.php" type="button" class="btn btn-warning my-1">Vedi tutte</a>
</div>
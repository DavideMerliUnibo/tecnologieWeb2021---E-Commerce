<h1 class="px-5">Shop</h1>

<?php foreach($templateParams["prodotti"] as $prodotto): ?>
<article class="row  align-items-center bg-light border p-2 m-2">
    <div class="col-4 col-lg-2">
        <img src="./img/<?php echo $prodotto["img"]; ?>" alt="" height="100"/>
    </div>
    <div class="col-8 col-lg-10">
        <h2 style="font-size: large;"><a href="product.php?prodotto=<?php echo $prodotto["codice"]; ?>"><?php echo $prodotto["nomeFungo"]; ?></a></h2>
        <p>venduto da <strong><?php echo $prodotto["username"]; ?></strong></p>
        <p><strong><?php echo $prodotto["prezzoPerUnità"]; ?> €/Kg</strong></p>
        <p><?php echo $prodotto["quantità"]; ?> in stock</p>
    </div>
</article>
<?php endforeach; ?>
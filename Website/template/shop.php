<h1 class="px-5">Shop</h1>

<?php foreach($templateParams["prodotti"] as $prodotto): ?>
<article class="row  align-items-center bg-light border p-2 m-2">
    <div class="col-4 col-lg-2">
        <img src="img/>" alt="" height="100"/>
    </div>
    <div class="col-8 col-lg-10">
        <h2 style="font-size: large;"><a href="#"><?php echo $prodotto["nomeFungo"]; ?></a></h2>
        <p>venduto da <strong><?php echo $prodotto["offerente"]; ?></strong></p>
        <p><strong><?php echo $prodotto["prezzoPerUnità"]; ?> €/Kg</strong></p>
        <p><?php echo $prodotto["quantità"]; ?> in stock</p>
    </div>
</article>
<?php endforeach; ?>
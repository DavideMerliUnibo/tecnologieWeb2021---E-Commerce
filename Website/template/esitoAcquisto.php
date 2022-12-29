<?php if (isset($_GET["error"])) : ?>
    <h1 class="mt-5 text-danger text-center">Qualcosa é andato storto, ti preghiamo di riprovare</h1>
<?php else : ?>
    <h1 class="mt-5 text-success text-center">Acquisto avvenuto con successo</h1>
<?php endif; ?>
<div class="my-5 d-flex justify-content-center"><button class="btn btn-secondary"><a class="text-dark" href="/tecnologieWeb2021---E-Commerce/Website/shop.php" style="text-decoration:none;">Torna allo shop</a></button></div>
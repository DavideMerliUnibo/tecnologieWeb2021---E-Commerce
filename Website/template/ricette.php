<h1 class="px-5 py-2">Ricette</h1>

<!-- Ricetta -->
<div class="row text-center mx-2">
    <?php foreach($templateParams["ricette"] as $ricetta): ?>
    <div class="card my-1 col-12 col-md-3 bg-light">
        <div class="row">
            <div class="col-6 col-md-12 mx-auto d-flex">
                <a href="paginaRicetta.php?titoloRicetta=<?php echo $ricetta["titolo"]; ?>">
                    <img src="<?php echo UPLOAD_DIR.$ricetta["img"]; ?>" class="img-fluid rounded-left mx-auto" alt="...">
                </a>
            </div>
            <div class="col-6 col-md-12">
                <div class="card-body">
                    <h5 class="card-title"><a href="paginaRicetta.php?titoloRicetta=<?php echo $ricetta["titolo"]; ?>"><?php echo $ricetta["titolo"]; ?></a></h5>
                    <p class="card-text"><?php echo $ricetta["descrizione"]; ?></p>
                    <p class="card-text"><small class="text-muted"><?php echo $ricetta["data"]; ?></small></p>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
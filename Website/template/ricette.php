<div class="container-fluid ">
    <div class="row">

        <!-- HDAVI: Questi servono??? -->
        <!-- <div class="btn-group col-5 d-none d-sm-flex m-auto"  role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check d-none" name="btnradio" id="btnradio1" autocomplete="off" checked>
            <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>
            <input type="radio" class="btn-check d-none" name="btnradio" id="btnradio2" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio2">Radio 2</label>
            <input type="radio" class="btn-check d-none" name="btnradio" id="btnradio3" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio3">Radio 3</label>
        </div> -->

        <div class="btn-group d-sm-none col">
            <button type="button" class="btn btn-secondary dropdown-toggle bg-dark text-light" data-bs-toggle="dropdown" aria-expanded="false">
            Filtri
            </button>
            <div class="dropdown-menu col-12">
                <div class="d-flex dropdown-item">
                    <p class="m-auto">Hey nice try</p>
                </div>
                <div class=" d-flex dropdown-item">
                    <p class="m-auto">Lol</p>
                </div>
            </div>
        </div>

    </div>

</div>

    <h2 class="px-5 py-2">Ricette</h2>

    <!-- Ricetta -->
    <div class="row p-3">
        <?php foreach($templateParams["ricette"] as $ricetta): ?>
        <div class="card my-1 col-12 col-md-3 px-0" >
            <div class="row">
                <div class="col-6 col-md-12 mx-auto d-flex">
                    <img src="<?php echo UPLOAD_DIR.$ricetta["img"]; ?>" class="img-fluid rounded-left mx-auto" alt="...">
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
</div>
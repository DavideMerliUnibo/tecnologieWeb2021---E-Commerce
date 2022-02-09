<div class="container-fluid">
    <div class="row">
        <div class="col d-flex">
            <button class="btn btn-primary ml-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">Menu</button>
            <div class="offcanvas offcanvas-start" id="offcanvasExample">
                <div class="offcanvas-body">
                    <button class="btn" id="gestisciRicetteButton">Gestisci ricette</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <section>

                </section>
            </div>
        </div>
    </div>
</div>
<script>
    $("#gestisciRicetteButton").on("click", event => {
        //forse meglio cosi`, non prende il focus sul main menu al primo click se faccio manualmente
        // $("#offcanvasExample").removeClass("show");
        // $("div .offcanvas-backdrop.show.fade").removeClass("show");
        $.get("template/gestisci-ricette.php", function(data) {
            $("section").html(data);
        });
    });
</script>
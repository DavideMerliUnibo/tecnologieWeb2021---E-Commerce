<div class="container-fluid">
    <div class="row">
        <div class="col d-flex">
            <button class="btn btn-primary ml-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">Menu</button>
            <div class="offcanvas offcanvas-start" id="offcanvasMenu">
                <div class="offcanvas-body">
                    <a class="btn" id="gestisciRicetteButton" href="http://localhost/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=gestisciRicette">Gestisci ricette</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <section>
                    <?php 
                        require($templateParams['inner']);
                    ?>
                </section>
            </div>
        </div>
    </div>
</div>

<!-- questo non serve piu perche` questa parte non e` piu dinamica il contenuto pero` lo e` -->
<!-- <script>
    
    $("#gestisciRicetteButton").on("click", event => {
        //forse meglio cosi`, non prende il focus sul main menu al primo click se faccio manualmente
        $("#offcanvasMenu").removeClass("show");
        $("div .offcanvas-backdrop.show.fade").removeClass("show");
        // $.get("template/gestisci-ricette.php", function(data) {
        //     $("section").html(data);
        // });

        $.ajax({
            url: "template/gestisci-ricette.php",
            cache: false,
            success: function(data) {
                $("section").html(data);
            }
        })
    });
</script> -->
<!-- <script>
    $("#gestisciRicetteButton").on("click", event => {
            window.location = "http://localhost/project/Website/home-utente.php?action=gestisciRicette";
        });
</script> -->
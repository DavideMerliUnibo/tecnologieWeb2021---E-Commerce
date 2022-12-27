<div class="container-fluid">
    <div class="row">
        <div class="row col-12 d-flex">
            <div class="col-2 col-lg-1">
                <button class="btn btn-primary ml-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">Menu</button>
            </div>
            <div class="col-8 col-lg-10"></div>

            <?php if(isset($_POST["logout"])){
                logOut();
            }?>

            <form method="post" class="col-2 col-lg-1">
                <input type="submit" name="logout" value="Log Out" class="btn btn-primary ml-auto" type="button" style="white-space: nowrap;"></input>
            </form>
            <div class="offcanvas offcanvas-start" id="offcanvasMenu">
                <div class="offcanvas-body">
                    <div class="vstack mt-2">
                        <a class="btn" id="gestisciRicetteButton" href="/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=gestisciRicette">Gestisci ricette</a>
                        <a class="btn" id="" href="/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=gestisciProdotti">Gestisci prodotti</a>
                        <a class="btn" id="" href="/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=gestisciInfoUtente">Gestisci info Utente</a>
                        <a class="btn" id="" href="/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=visualizzaProdottiVenduti">Visualizza prodotti venduti</a>
                        <a class="btn" id="" href="/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=visualizzaAcquisti">Visualizza acquisti passati</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <section id="innerTemplate">
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
            window.location = "http://localhost/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=gestisciRicette";
        });
</script> -->
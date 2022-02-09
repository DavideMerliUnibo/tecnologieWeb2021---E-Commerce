<main>
    <h1 class="p-2">Fungo porcino molto buono</h1>

    <?php $prodotto = $templateParams["prodotto"][0]; ?>
    <?php $immagini = $templateParams["immagini"]; ?>
    <!-- Articolo -->
    <article class="bg-light border p-2 m-2">
        <div class="mb-2 mt-2 align-items-center">
            <!-- Farlo per ogni immagine -->
            <img src="img/<?php echo $immagini[0]["nome"]; ?>" alt="" class="w-100"/>
        </div>
        <p>Venduto da: <strong><?php echo $prodotto["username"]; ?></strong></p>
        <p>Prezzo: <strong><?php echo $prodotto["prezzoPerUnità"]; ?> €/Kg</strong></p>
        <p>Informazioni:</p>
        <p class="px-2"><?php echo $prodotto["informazioni"]; ?></p>
    </article>

    <!-- Recensioni degli utenti -->
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">Recensioni degli utenti</h2>
                <div style="overflow-y: scroll;height: 400px;" tabindex="0" class="">
                    <!-- Un article per ogni commento -->
                    <article class="row col-12 bg-light card-body my-1 border-bottom">
                        <div class="col-4 col-lg-2">
                            <img src="img/profile.png" alt="img" height="100"/>
                        </div>
                        <div class="col-8 col-lg-10">
                            <h2 style="font-size: large;">Bene ma non benissimo</h2>
                            <p>by <strong>Giovanna</strong></p>
                            <p>Buono, niente da dire, ma la confezione non era il top</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</main>
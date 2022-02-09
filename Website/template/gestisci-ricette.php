<div class="row">
    <div class="col d-flex justify-content-center">
        <div class="row" id="gestisciRicetteRow">
            <div class="col-12 text-center">
                <h2>Gestisci Ricette</h2>
            </div>
            <div class="col-12 text-center">
                <button class="fs-0 btn btn-sm btn-info" type="button" name="inserisciButton" >Inserisci ricetta</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("button[name='inserisciButton']").click(function(){
        $("#gestisciRicetteRow div > h2").html("Inserisci ricetta");
        $("#gestisciRicetteRow div:nth-child(2)").load("template/inserisci-ricetta.php");
    });
</script>
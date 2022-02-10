<?php
// require("../bootstrap.php");
//require("/xampp/htdocs/project/Website/bootstrap.php");
if (!isUserLoggedIn()) {
    die();
}
$index = 0;
$ricette = $dbh->getRicetteUtente();
?>
<div class="row">
    <div class="modal fade" id="modalComponent" tabindex="-1" aria-labelledby="modalComponent" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">

                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="row" id="gestisciRicetteRow">
            <div class="col-12 text-center">
                <h2>Gestisci Ricette</h2>
            </div>
            <div class="col-12 text-center mb-2">
                <button class="fs-0 btn btn-sm btn-info" type="button" name="inserisciButton">Inserisci ricetta</button>
            </div>
            <div class="col-12 table-responsive">


            </div>
        </div>
    </div>
</div>
<script>
    $().ready(function() {
        loadContent();
    })

    function loadContent() {
        $.ajax({
            method: "post",
            url: "api-gestione-ricetta.php",
            cache: false,
            data: {
                "action": "content"
            },
            success: function(data) {
                console.log(data);
                let content = buildContent(data);
                $("#gestisciRicetteRow div:nth-child(3)").addClass("table-responsive");
                $("#gestisciRicetteRow div:nth-child(3)").html(content);
            }
        })
    }

    function buildContent(data) {
        let content = `<table class="table text-center table-sm">
                    <thead class="table-light">
                        <th>Titolo</th>
                        <th>Tab. nutrizionale</th>
                        <th>difficoltà</th>
                        <th>descrizione</th>
                        <th>Procedimento</th>
                        <th>Consigli</th>
                        <th>Data</th>
                        <th>Autore</th>
                        <th>Gestisci</th>
                    </thead>
                    <tbody class="">`;
        if (data.length == 0) {
            content += `<td class="text-center" colspan="8">Nessuna ricetta inserita</td>`;
        } else {
            for (ricetta of data) {
                let valoriNutriz = [ricetta["valoreEnergetico"], ricetta['proteine'], ricetta["grassi"], ricetta["carboidrati"], ricetta["fibre"], ricetta["sodio"]];
                content += `<tr>
                            <td>${ricetta['titolo']}</td>
                            <td>
                                <button onclick='setModal(${JSON.stringify(valoriNutriz)},"Tabella Nutrizionale");' class="btn btn-light mx-auto" type="button" data-bs-toggle="modal" data-bs-target="#modalComponent" aria-controls="modalComponent">look</button>
                            </td>
                            <td>${ricetta['difficoltà']}</td>
                            <td>
                                <button onclick='setModal(${ricetta['descrizione']},"Descrizione");' type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalComponent">Descrizione</button>
                            </td>
                            <td>
                                <button onclick='setModal(${ricetta['procedimento']},"Procedimento");' type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalComponent">Procedimento</button>
                            </td>
                            <td>
                                <button onclick='setModal(${ricetta['consigli']},"Consigli");' type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalComponent">Consigli</button>
                            </td>
                            <td>
                                ${ricetta['data']}
                            </td>
                            <td>
                                ${ricetta['autore']}
                            </td>
                            <td>
                                <button onclick="deleteRow(${ricetta['titolo']});" class="btn btn-sm btn-light">Delete</button>
                                <button onclick='updateRow(${JSON.stringify(ricetta)});' class="btn btn-sm btn-light">Update</button>
                            </td>
                            </tr>`;
            }
        }
        content += ` </tbody>
                </table>`;
        return content;
    }

    $("button[name='inserisciButton']").click(function() {
        $("#gestisciRicetteRow div > h2").html("Inserisci ricetta");
        // $("#gestisciRicetteRow div:nth-child(3)").load("template/inserisci-ricetta.php");

        $.ajax({
            url: "template/inserisci-ricetta.php",
            cache: false,
            success: function(data) {
                $("#gestisciRicetteRow div:nth-child(3)").html(data);
            }
        })
    });

    function updateRow(values) {
        console.log(values);
        $.ajax({
            method: "post",
            url: "template/modifica-ricetta.php",
            cache: false,
            // data: {
            //     values: JSON.stringify(values)
            // },
            success: function(data) {
                $("#gestisciRicetteRow div:nth-child(3)").html(data);
                //modifico ogni riga del template con value giusto di riga
                //aggiungo script che faccia update
                $("#titolo").val(values['titolo']);
                $("#difficoltà").val(values['difficoltà']);
                $("#descrizione").val(values['descrizione']);
                $("#procedimento").val(values['procedimento']);
                $("#consigli").val(values['consigli']);
                $("#valoreEnergetico").val(values['valoreEnergetico']);
                $("#proteine").val(values['proteine']);
                $("#grassi").val(values['grassi']);
                $("#carboidrati").val(values['carboidrati']);
                $("#fibre").val(values['fibre']);
                $("#sodio").val(values['sodio']);
            }
        })
    }

    function deleteRow(titolo) {
        $.ajax({
            method: 'post',
            url: "api-gestione-ricetta.php",
            cache: false,
            data: {
                "action": "delete",
                "titolo": titolo
            },
            success: function() {
                loadContent();
            }
        })
    }

    function setModal(value, header) {
        switch (header) {
            case "Consigli":
            case "Procedimento":
            case 'Descrizione':
                $("#modalComponent div.modal-header").html(
                    `<h2>${header}</h2>`
                );
                $(".modal-dialog").addClass("modal-dialog-scrollable");
                $(".modal-body").html(
                    `<p>${value}</p>`
                );
                break;
            case 'Tabella Nutrizionale':
                console.log(value);
                $("#modalComponent div.modal-header").html(
                    `<h2>${header}</h2>`
                );
                $(".modal-dialog").removeClass("modal-dialog-scrollable");
                $("#modalComponent div.modal-body").html(
                    `<div class="table-responsive">
                        <table class="table table-light table-striped">
                            <tr>
                                <th>Valore energetico</th>
                                <td>${value[0]}</td>
                            </tr>
                            <tr>
                                <th>Proteine</th>
                                <td>${value[1]}g</td>
                            </tr>
                            <tr>
                                <th>Carboidrati</th>
                                <td>${value[2]}g</td>
                            </tr>
                            <tr>
                                <th>Grassi</th>
                                <td>${value[3]}g</td>
                            </tr>
                            <tr>
                                <th>Fibre</th>
                                <td>${value[4]}g</td>
                            </tr>
                            <tr>
                                <th>Sale</th>
                                <td>${value[5]}g</td>
                            </tr>
                        </table>
                    </div>`);
                break;




        }
    }
</script>
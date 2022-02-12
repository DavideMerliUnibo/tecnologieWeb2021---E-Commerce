<?php
// require("../bootstrap.php");
//require("/xampp/htdocs/tecnologieWeb2021---E-Commerce/Website/bootstrap.php");
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
                            <td>${JSON.stringify(ricetta['titolo'])}</td>
                            <td>
                                <button onclick='setModal(${JSON.stringify(valoriNutriz)},"Tabella Nutrizionale");' class="btn btn-light mx-auto" type="button" data-bs-toggle="modal" data-bs-target="#modalComponent" aria-controls="modalComponent">look</button>
                            </td>
                            <td>${JSON.stringify(ricetta['difficoltà'])}</td>
                            <td>
                                <button onclick='setModal(${JSON.stringify(ricetta['descrizione'])},"Descrizione");' type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalComponent">Descrizione</button>
                            </td>
                            <td>
                                <button onclick='setModal(${JSON.stringify(ricetta['procedimento'])},"Procedimento");' type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalComponent">Procedimento</button>
                            </td>
                            <td>
                                <button onclick='setModal(${JSON.stringify(ricetta['consigli'])},"Consigli");' type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalComponent">Consigli</button>
                            </td>
                            <td>
                                ${JSON.stringify(ricetta['data'])}
                            </td>
                            <td>
                                ${JSON.stringify(ricetta['autore'])}
                            </td>
                            <td>
                                <button onclick='deleteRow(${JSON.stringify(ricetta['titolo'])});' class="btn btn-sm btn-light">Delete</button>
                                <button onclick='updateRow(${JSON.stringify(ricetta)});' class="btn btn-sm btn-light">Update</button>
                                <button onclick='imag(${JSON.stringify(ricetta['titolo'])});' class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#modalComponent" aria-controls="modalComponent">Img</button>
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
            //forse meglio mettere diretto il template se non dobbiamo farci niente col form di modifica ricetta.
            url: "template/modifica-ricetta.php",
            cache: false,
            // data: {
            //     values: JSON.stringify(values)
            // },
            success: function(data) {
                $("#gestisciRicetteRow div:nth-child(3)").html(data);
                //modifico ogni riga del template con value giusto di riga
                //aggiungo script che faccia update
                $("#titolo").val(values['titolo']).attr('placeholder', values['titolo']);
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
        console.log(titolo);
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

    function imag(titolo) {
        $.ajax({
            method: "post",
            data: {
                'action': 'img',
                'titolo': titolo
                // 'titolo': 'Risotto ai porcini '
            },
            url: "api-gestione-ricetta.php",
            cache: false,
            success: function(data) {
                setModal(data, 'img', titolo);
                console.log(data);
            }
        })
    }

    function setModal(value, header, titolo = null) {
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
            case 'img':
                let content = createImgModalContent(value, titolo);
                $("#modalComponent div.modal-header").html(
                    `
                    <div class="d-flex flex-column justify-content-center">
                        <h2>Gestisci Immagini</h2>
                        <button class="btn btn-light btn-sm" onclick='setModal("${titolo}","imgInsert","${titolo}")' >Aggiungi immagine</button>
                    </div>
                    `
                );
                $(".modal-dialog").addClass("modal-dialog-scrollable");
                $("#modalComponent div.modal-body").html(content);
                break;
            case 'imgInsert':
                let cont = `
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                            <form id="form" action="ajaxupload.php" method="post" enctype="multipart/form-data">
                                <div class="d-flex flex-column">
                                    <input id="uploadImage" type="file" accept="image/*" name="image" class="form-control mb-2"/>
                                    <input type="submit" class="btn btn-light btn-sm w-50 mx-auto" name="Upload" value="Upload"></button>
                                </div>
                            </form>
                            </div>
                `;

                cont += `</div></div>`;
                $("#modalComponent div.modal-header").html(
                    `
                    <div class="d-flex flex-column justify-content-center">
                        <h2>Inserisci Immagine</h2>
                    </div>
                    `
                );
                $(".modal-dialog").addClass("modal-dialog-scrollable");
                $("#modalComponent div.modal-body").html(cont);
                break;

        }
    }

    //  function loadImgModalContent(value,titolo){
    //     let content = createImgModalContent(value,titolo);
    //     $("#modalComponent div.modal-body").html(content);
    // }
    function createImgModalContent(value, titolo) {
        let content = `
                    <div 
                    <div class='row justify-content-start'>
                `;
        if (value.length == 0) {
            content += `<p class="text-center">nessuna immagine presente</p>`;
        }
        for (img of value) {
            content += `
                    <div class="col-3">
                        <img src='${'/tecnologieWeb2021---E-Commerce/Website/upload/'+img['nome']}' alt='${img['nome']}' class="img-thumbnail">
                        <div class="d-flex">
                            <p class="ms-1">${img['nome']}</p>
                            <button class="text-danger btn  bg-white" onclick='removeImg(${JSON.stringify(img['nome'])},"${titolo}")'>x</button>
                        </div>
                    </div>`;
        }
        content += `</div>`;
        return content;
    }

    function removeImg(nome, titolo) {
        $.ajax({
            method: 'post',
            url: 'api-gestione-ricetta.php',
            data: {
                'action': 'imgRemove',
                'titolo': titolo,
                'nome': nome
            },
            cache: false,
            success: function(data) {
                console.log(titolo + ' ' + nome + ' ' + data);
                imag(titolo);
            }
        })
    }

    
    $(document).ready(function(e) {
        $("input[name=Upload]").on('click', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "ajaxupload.php",
                type: "POST",
                data: new FormData($("#form")),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    //window.location = 'http://localhost/tecnologieWeb2021---E-Commerce/Website/home-utente.php';
                },
                error: function(e) {
                }
            });
            return false;
        }));
    });
</script>
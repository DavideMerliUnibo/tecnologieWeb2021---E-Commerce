<?php
 //require("../bootstrap.php");
//require("/tecnologieWeb2021---E-Commerce/Website/bootstrap.php");
if (!isUserLoggedIn()) {
    die();
}
$ricette = $dbh->getProdottiUtente();
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
        <div class="row" id="gestisciProdottiRow">
            <div class="col-12 text-center">
                <h2>Gestisci Prodotti</h2>
            </div>
            <div class="col-12 text-center mb-2">
                <button class="fs-0 btn btn-sm btn-info" type="button" name="inserisciButton">Inserisci prodotto</button>
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
            url: "api-gestione-prodotti.php",
            cache: false,
            data: {
                "action": "content"
            },
            success: function(data) {
                console.log(data);
                let content = buildContent(data);
                $("#gestisciProdottiRow div:nth-child(3)").addClass("table-responsive");
                $("#gestisciProdottiRow div:nth-child(3)").html(content);
            }
        })
    }

    function buildContent(data) {
        let content = `<table class="table text-center table-sm">
                    <thead class="table-light">
                        <th>Nome Fungo</th>
                        <th>Pezzo unità</th>
                        <th>Quantità</th>
                        <th>Descrizione</th>
                        <th>Data </th>
                        <th>Gestisci</th>
                    </thead>
                    <tbody class="">`;
        if (data.length === 0) {
            content += `<td class="text-center" colspan="8">Nessuna ricetta inserita</td>`;
        } else {
            for (prodotto of data) {
                content += `<tr>
                            <td> ${JSON.stringify(prodotto['nomeFungo'])}</td>
                            <td>${JSON.stringify(prodotto["prezzoPerUnità"])}</td>
                            <td>${JSON.stringify(prodotto["quantità"])}</td>
                            <td><button onclick='setModal(${JSON.stringify(prodotto['informazioni'])},"Descrizione");' type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalComponent">Descrizione</button></td>
                            <td>${JSON.stringify(prodotto["data"])}</td>
                            <td>
                                <button onclick='deleteRow(${JSON.stringify(prodotto['codice'])});' class="btn btn-sm btn-light">Delete</button>
                                <button onclick='updateRow(${JSON.stringify(prodotto)});' class="btn btn-sm btn-light">Update</button>
                                <button onclick='imag(${JSON.stringify(prodotto['codice'])});' class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#modalComponent" aria-controls="modalComponent">Img</button>
                             </td>
                            </tr>`;
            }
        }
        content += ` </tbody>
                </table>`;
        return content;
        
    }

    $("button[name='inserisciButton']").click(function() {
        $("#gestisciProdottiRow div > h2").html("Inserisci Prodotto");
        $.ajax({
            url: "template/inserisci-prodotto.php",
            cache: false,
            success: function(data) {
                $("#gestisciProdottiRow div:nth-child(3)").html(data);
            }
        })
    });

    function updateRow(values) {
        console.log(values);
        $.ajax({
            method: "post",
            //forse meglio mettere diretto il template se non dobbiamo farci niente col form di modifica ricetta.
            url: "template/modifica-prodotto.php",
            cache: false,
           
            success: function(data) {
                $("#gestisciProdottiRow div:nth-child(3)").html(data);
                //modifico ogni riga del template con value giusto di riga
                //aggiungo script che faccia update
                $("#nomeFungo").val(values["nomeFungo"]);
                $("#descrizione").val(values["informazioni"]);
                $("#quantità").val(values["quantità"]).next().val(values["prezzoPerUnità"]);
                $("#prezzoUnità").val(values["prezzoPerUnità"]).next().val(values["prezzoPerUnità"]);
                $("#idProdotto").val(values["codice"]);
            }
        })
    }

    function deleteRow(codice) {
        console.log(codice);
        $.ajax({
            method: 'post',
            url: "api-gestione-prodotti.php",
            cache: false,
            data: {
                "action": "delete",
                "codice": codice
            },
            success: function() {
                loadContent();
            }
        })
    }

    function imag(codice) {
        $.ajax({
            method: "post",
            data: {
                'action': 'img',
                'codice': codice
            },
            url: "api-gestione-prodotti.php",
            cache: false,
            success: function(data) {
                setModal(data, 'img', codice);
                console.log(data);
            }
        })
    }

    function setModal(value, header, codice = null) {
        switch (header) {
            case 'Descrizione':
                $("#modalComponent div.modal-header").html(
                    `<h2>${header}</h2>`
                );
                $(".modal-dialog").addClass("modal-dialog-scrollable");
                $(".modal-body").html(
                    `<p>${value}</p>`
                );
                break;
            case 'img':
                let content = createImgModalContent(value, codice);
                $("#modalComponent div.modal-header").html(
                    `
                    <div class="d-flex flex-column justify-content-center">
                        <h2>Gestisci Immagini</h2>
                        <button class="btn btn-light btn-sm" onclick='setModal("${codice}","imgInsert","${codice}")' >Aggiungi immagine</button>
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
                                <form id="form" action="ajaxupload.php"  method="post" enctype="multipart/form-data">
                                    <div class="d-flex flex-column">
                                        <input id="uploadImage" type="file" accept="image/*" name="image" class="form-control mb-2"/>
                                        <input type="submit" class="btn btn-light btn-sm w-50 mx-auto" name="Upload" value="Upload"/>
                                        <input type="text" hidden name="codProdotto" value="${codice}"/>
                                    </div>
                                </form>
                            </div>
                        </div>
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

    function createImgModalContent(value, codice) {
        let content = `
                    <div 
                    <div class='row justify-content-start'>
                `;
        if (value.length == 0) {
            content += `<p class="text-center">nessuna immagine presente</p>`;
        }
        for (img of value) {
            content += `
                    <div class="col-3 d-flex flex-column">
                        <img src='${'/tecnologieWeb2021---E-Commerce/Website/upload/'+img['nome']}' alt='${img['nome']}' class="img-thumbnail">
                        <div class="d-flex">
                            <p class="ms-1" style="word-break: break-word;">${img['nome']}</p>
                            <button class="text-danger btn  bg-white" onclick='removeImg(${JSON.stringify(img['nome'])},"${codice}")'>x</button>
                        </div>
                    </div>`;
        }
        content += `</div>`;
        return content;
    }

    function removeImg(nome, codice) {
        $.ajax({
            method: 'post',
            url: 'api-gestione-prodotti.php',
            data: {
                'action': 'imgRemove',
                'codice': codice,
                'nome': nome
            },
            cache: false,
            success: function(data) {
                console.log(codice + ' ' + nome + ' ' + data);
                imag(codice);
            }
        })
    }

  
</script>
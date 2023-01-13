<?php require "../template/inserisci-modifica-template-form-prodotto.php";?>
<script>
    $().ready(function(){
        $("input[name=submitProdotto]").attr('onclick','return inserisciProdotto();').val('Inserisci');

    });
function inserisciProdotto() {
    let elems = $("form#formGestioneProdotti input,form#formGestioneProdotti textarea,form#formGestioneProdotti select").toArray();
    elems = elems.map(x => {
        return [x.attributes['name'].value, x.value];
    });
    let data = "{";
    for (let i = 0; i < elems.length; i++) {
        data += '\"' + elems[i][0] +'\"' + ":" +'\"' + elems[i][1]+'\"';
        if (i == elems.length - 1) {
            data += '}';
            break;
        }
        data += ','
    }
    console.log(data);

    $.ajax({
        type: "post",
        url: "api-gestione-prodotti.php",
        data: {
            'data': data,
            'action':"insert",
            'submitProdotto': 'inserisci'
        },
        cache: false,
        success: function(result) {
            console.log(result);
            console.log('ciao');
            window.location="http://localhost/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=gestisciProdotti&toast=addProd";
        }
    });
    return false;
};
</script>
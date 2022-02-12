<?php require "/xampp/htdocs/tecnologieWeb2021---E-Commerce/Website/template/inserisci-modifica-template-form.php";?>
<script>
    $().ready(function(){
        $("input[name=submitRicetta]").attr('onclick','return modificaRicetta();').val('Aggiorna');

    });
function modificaRicetta() {
    let elems = $("form input,form textarea").toArray();
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
        // url: "login.php",
        url: "api-gestione-ricetta.php",
        data: {
            'data': data,
            'titolo': $('input[name=titolo]').attr('placeholder'),
            'action':"update",
            'submitRicetta': 'aggiorna'
        },
        cache: false,
        success: function(result) {
            console.log(result);
            console.log('ciao');
            window.location="http://localhost/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=gestisciRicette";
        }
    });
    return false;
};
</script>
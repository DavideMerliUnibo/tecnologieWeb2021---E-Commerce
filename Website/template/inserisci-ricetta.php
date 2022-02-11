<?php require "/xampp/htdocs/project/Website/template/inserisci-modifica-template-form.php"?>
<script>
    function inserisciRicetta() {
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
                'action':"insert",
                'submitRicetta': 'inserisci'
            },
            cache: false,
            success: function(result) {
                window.location="http://localhost/project/Website/home-utente.php?action=gestisciRicette";
            }
        });
        return false;
    };
</script>
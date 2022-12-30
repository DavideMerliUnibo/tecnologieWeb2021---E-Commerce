<?php

if (!isUserLoggedIn()) {
    die();
}

require "template/registrazione-form.php"

?>
<script>
    $("div img.card-img-top").parent().remove();
    $("div.card div.card-body h1").text("Aggiorna informazioni");
    $("button[type=submit]").text("Update").attr("onclick", "return updateUser();");

    $().ready(function(){
        $.ajax({
            type: "post",
            url: "api-gestione-infoUtente.php",
            data: {
                'action':"currentInfo",
            },
            cache: false,
            success: function(result) {
                console.log(result);
                //fare bind di dati ricevuti a inputs, anche password maybe altrimenti quando aggiorna poi cambia la password oppure fare che cambia la pa
                // password solo se inserisce qualcosa.
                let data = result[0];
                $("input#usernameInput").val(data["username"]);
                $("input#nomeInput").val(data["nome"]);

                $("input#cognomeInput").val(data["cognome"]);
                $("input#emailInput").val(data["email"]);
                $("input#passwordInput").val(data["password"]);
                $("input#indirizzoInput").val(data["indirizzo"]);
                $("input#dataNascitaInput").val(data["data nascita"]);
                $("textarea#infoUtente").val(data["info_venditore"]);
            }
        });
    });

    function updateUser() {
        let elems = $("form#form-register-update input,form#form-register-update textarea").toArray();
        elems = elems.map(x => {
            return [x.attributes['name'].value, x.value];
        });
        let data = "{";
        for (let i = 0; i < elems.length; i++) {
            data += '\"' + elems[i][0] + '\"' + ":" + '\"' + elems[i][1] + '\"';
            if (i == elems.length - 1) {
                data += '}';
                break;
            }
            data += ','
        }
        console.log(data);
        $.ajax({
            type: "post",
            url: "api-gestione-infoUtente.php",
            data: {
                'action':"updateUser",
                "data" : data
            },
            cache: false,
            success: function(result) {
                console.log(result);
                console.log("oki");
                window.location="http://localhost/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=gestisciInfoUtente&toast=updateInfo";
            }
        });
       
        return false;
    }
</script>
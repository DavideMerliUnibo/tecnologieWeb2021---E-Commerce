<div class="container">
    <div class="row">
        <?php if (isset($templateParams['errorMessage'])){
            echo '<script type="text/javascript">toastr.error("'.$templateParams["errorMessage"].'");</script>';
        }?>
        <div class="col-12 col-md-8 m-auto">
            <div class="card">
                <div class="jumbotron jumbotron-fluid py-5 my-0" style="background: url('<?php echo UPLOAD_DIR ?>forest1.jpg') no-repeat center; background-size: cover;">
                </div>
                <div class="card-body">
                    <h1 class="text-center card-title">Registrazione</h1>

                    <form method="post" action="#" id="form-register-update">
                        <div class="row my-3">
                            <div class="col-12 d-flex justify-content-start">
                                <input class="form-control form-control-sm" type="text" name="username" id="usernameInput" placeholder="Username" />
                                <label class="form-label w-100" for="usernameInput" hidden>Username </label>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-6 d-flex justify-content-start">
                                <input class="form-control form-control-sm" type="text" name="nome" id="nomeInput" placeholder="Nome">
                                <label class="form-label w-100" for="nomeInput" hidden>Nome </label>
                            </div>
                            <div class="col-6 d-flex justify-content-start">
                                <input class="form-control form-control-sm" type="text" name="cognome" id="cognomeInput" placeholder="Cognome">
                                <label class="form-label w-100" for="cognomeInput" hidden>Cognome </label>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-6 d-flex justify-content-start">
                                <input class="form-control form-control-sm" type="email" name="email" id="emailInput" placeholder="Email">
                                <label class="form-label w-100" for="emailInput" hidden>Email </label>
                            </div>
                            <div class="col-6 d-flex justify-content-start">
                                <input class="form-control form-control-sm" type="password" name="password" id="passwordInput" placeholder="Password">
                                <label class="form-label w-100" for="passwordInput" hidden>Password </label>
                            </div>
                        </div>
                        <?php if (isset($templateParams["errorMessage"]) && str_contains($templateParams["errorMessage"], "Password")): ?>
                            <div class="col-12 text-center" style="color:red;">
                                La password deve avere una lunghezza di almeno 8 caratteri e contenere almeno una lettera minuscola, una lettera maiuscola, un numero e un carattere speciale.
                            </div>
                            <?php unset($templateParams["errorMessage"]); ?>
                        <?php endif; ?>
                        <div class="row my-3">
                            <div class="col">
                                <input class="form-control form-control-sm" type="text" name="indirizzo" id="indirizzoInput" placeholder="Indirizzo">
                                <label class="form-label w-100" for="indirizzoInput" hidden>Indirizzo</label>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <input class="form-control form-control-sm" type="date" name="dataNascita" id="dataNascitaInput"  placeholder="Data di nascita" />
                                <label class="form-label w-100" for="dataNascitaInput" style="font-size:15px" >Data di Nascita</label>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <textarea class="form-control form-control-sm" name="infoUtente" id="infoUtente" ></textarea>
                                <label class="form-label w-100 text-small" for="infoUtente" style="font-size:15px" >Info Utente</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex">
                                <button class="btn btn-success mx-auto" type="submit" name="submit">Subscribe</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
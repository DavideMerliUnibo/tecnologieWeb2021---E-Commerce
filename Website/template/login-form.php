<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="row">
                    <div class="col-5">
                        <img class="img-fluid rounded-start " src="./img/fungologin.jpg" alt="immagine fungo">
                    </div>
                    <div class="col-7 d-flex">
                        <div class="card-body mt-4">
                            <h1 class="text-center text-info">Login</h1>
                            <?php if(isset($templateParams["erroreLogin"])): ?>
                                <p class="text-center text-danger"><?php echo $templateParams["erroreLogin"]; ?></p>
                            <?php endif;?>
                            <form method="POST" action="#">
                                <div class="my-4">
                                    <label class="form-label" for="emailLogin" hidden>Email</label>
                                    <input class="form-control" type="text" id="emailLogin" name="email" placeholder="Email"/>
                                </div>
                                <div class="my-3">
                                    <label class="form-label" for="passwordLogin" hidden>Email</label>
                                    <input class="form-control" type="password" id="passwordLogin" name="password" placeholder="Password"/>
                                </div>
                                <div class="my-2 d-flex">
                                    <button class="btn btn-info w-75 m-auto" type="submit">Login</button>
                                </div>
                            </form>
                            <div class="d-flex">
                                <p class="fw-light m-auto">Non hai un account? <a href="registrazione.php">Registrati!</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
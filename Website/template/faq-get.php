<h1 class="px-5 py-2">Le FAQ più comuni</h1>

<p>
  <a class="btn btn-primary mx-3 mt-3" data-bs-toggle="collapse" href="#contatti" role="button" aria-expanded="false" aria-controls="collapseExample">
    Come contattarci?
  </a>
</p>

<div class="collapse mx-3" id="contatti">
  <div class="card card-body bg-light" id="f">
    Invia un'email all'indirizzo tuttofungo.it@gmail.com.
  </div>
</div>

<p>
  <a class="btn btn-primary mx-3 mt-3" data-bs-toggle="collapse" href="#allergie" role="button" aria-expanded="false" aria-controls="collapseExample">
    Allergie?
  </a>
</p>

<div class="collapse mx-3" id="allergie">
  <div class="card card-body bg-light" id="f">
    Documentati con cura prima di effettuare acquisti. Tuttofungo.it è una piattaforma in cui qualunque utente può vendere prodotti a piacimento, e pertanto non si prende la responsabilità di eventuali danni causati ai compratori.
  </div>
</div>

<p>
  <a class="btn btn-primary mx-3 mt-3" data-bs-toggle="collapse" href="#funghiDisponibili" role="button" aria-expanded="false" aria-controls="collapseExample">
    Che tipi di funghi posso vendere?
  </a>
</p>

<div class="collapse mx-3" id="funghiDisponibili">
  <div class="card card-body bg-light" id="f">
    Il nostro database comprende una limitata selezione di funghi. Al momento abbiamo:
    <ul>
      <?php foreach($dbh -> getProducts() as $p): ?>
        <li><?php echo $p["nomeFungo"];?></li>
      <?php endforeach; ?>
    </ul>
    Per aggiungere altre specie di funghi inviaci una mail con il nome della specie. Ti notificheremo non appena tale fungo è disponibile per la vendita.
  </div>
</div>

<p>
  <a class="btn btn-primary mx-3 mt-3" data-bs-toggle="collapse" href="#ricetta" role="button" aria-expanded="false" aria-controls="collapseExample">
    Posso aggiungere qualsiasi tipo di ricetta?
  </a>
</p>

<div class="collapse mx-3" id="ricetta">
  <div class="card card-body bg-light" id="f">
    Sì, purché tale ricetta contenga un qualche tipo di funghi e sia ben documentata. Ogni ricetta che non rispetta tali caratteristiche verrà automaticamente rimossa entro un paio di giorni lavorativi.
  </div>
</div>

<p>
  <a class="btn btn-primary mx-3 mt-3" data-bs-toggle="collapse" href="#commentiRecensioni" role="button" aria-expanded="false" aria-controls="collapseExample">
    Se non riesco ad aggiungere commenti e recensioni?
  </a>
</p>

<div class="collapse mx-3" id="commentiRecensioni">
  <div class="card card-body bg-light" id="f">
    Per aggiungere commenti e recensioni è necessario effettuare il login.
  </div>
</div>

<p>
  <a class="btn btn-primary mx-3 mt-3" data-bs-toggle="collapse" href="#notifiche" role="button" aria-expanded="false" aria-controls="collapseExample">
    Come faccio a sapere se qualcuno ha comprato un mio prodotto?
  </a>
</p>

<div class="collapse mx-3" id="notifiche">
  <div class="card card-body bg-light" id="f">
    Effettua l'accesso e controlla la sezione "Notifiche" dell'area personale. Se qualcuno ha acquistato un tuo prodotto, vi comparirà un'apposita notifica.
  </div>
</div>
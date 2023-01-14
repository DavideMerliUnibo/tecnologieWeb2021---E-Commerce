<?php
// require("../bootstrap.php");
//require("/xampp/htdocs/tecnologieWeb2021---E-Commerce/Website/bootstrap.php");
if (!isUserLoggedIn()) {
    die();
}
$notifiche = $dbh->getNotifiche();
$thisPage = "http://localhost/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=visualizzaNotifiche";
?>

<h2 class="text-center py-2">Notifiche</h2>

<?php if($notifiche != NULL): ?>
<div class="table-responsive">
    <table id="tab" class="table table-striped table-hover text-center align-middle table-sm">
        <thead class="table-light">
            <th>Data</th>
            <th>Messaggio</th>
            <th>Gestisci</th>
        </thead>
    
        <tbody>
        <?php foreach($notifiche as $notifica): ?>
            <tr>
                <td style="white-space:nowrap;"><?php echo $notifica["data"]; ?></td>
                <td><?php echo $notifica["messaggio"]; ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="notifica" value="<?php echo $notifica["codice"]; ?>"></input>
                        <input type="submit" name="deleteNotifica" value="Delete" class="btn btn-sm btn-light"></input>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<?php if($notifiche == NULL): ?>
<div class="text-center">Nessuna notifica</div>
<?php endif; ?>
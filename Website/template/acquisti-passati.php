<?php
// require("../bootstrap.php");
//require("/xampp/htdocs/tecnologieWeb2021---E-Commerce/Website/bootstrap.php");
if (!isUserLoggedIn()) {
    die();
}
$acquisti = $dbh->getAcquisti();
?>

<h2 class="text-center py-2">Acquisti passati</h2>

<?php if($acquisti != NULL): ?>
<div class="table-responsive">
    <table id="tab" class="table table-striped text-center table-sm" style="white-space:nowrap;">
        <thead class="table-light">
            <th>Data</th>
            <th>Fungo</th>
            <th>Quantità</th>
            <th>Totale</th>
        </thead>
    
        <tbody>
        <?php foreach($acquisti as $acquisto): ?>
            <tr>
                <td><?php echo $acquisto["data"]; ?></td>
                <td><?php echo $acquisto["nomeFungo"]; ?></td>
                <td><?php echo $acquisto["quantità"]; ?></td>
                <td><?php echo $acquisto["totale"]; ?> €</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    
    </table>
</div>
<?php endif; ?>

<?php if($acquisti == NULL): ?>
<div class="text-center">Nessun acquisto trovato</div>
<?php endif; ?>
<?php
// require("../bootstrap.php");
//require("/xampp/htdocs/tecnologieWeb2021---E-Commerce/Website/bootstrap.php");
if (!isUserLoggedIn()) {
    die();
}
$vendite = $dbh->getProdottiVenduti();
?>

<h2 class="text-center py-2">Prodotti venduti</h2>

<?php if($vendite != NULL): ?>
<div class="table-responsive">
    <table id="tab" class="table table-striped text-center table-sm" style="white-space:nowrap;">
        <thead class="table-light">
            <th>N. ordine</th>
            <th>Data</th>
            <th>Fungo</th>
            <th>Quantità</th>
            <th>Totale</th>
            <th>Acquirente</th>
        </thead>
    
        <tbody>
        <?php foreach($vendite as $vendita): ?>
            <tr>
                <td><?php echo $vendita["codice"]; ?></td>
                <td><?php echo $vendita["data"]; ?></td>
                <td><?php echo $vendita["nomeFungo"]; ?></td>
                <td><?php echo $vendita["quantità"]; ?></td>
                <td><?php echo $vendita["totale"]; ?> €</td>
                <td><?php echo $vendita["username"]; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<?php if($vendite == NULL): ?>
<div class="text-center">Nessun prodotto venduto</div>
<?php endif; ?>
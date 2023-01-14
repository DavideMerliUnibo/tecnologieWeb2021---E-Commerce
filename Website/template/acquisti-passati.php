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
    <table id="tab" class="table text-center align-middle table-sm" style="white-space:nowrap;">
        <thead class="table-light">
            <th>Data</th>
            <th>Fungo</th>
            <th>Quantità</th>
            <th>Totale</th>
        </thead>
    
        <tbody>
        <?php foreach($acquisti as $acquisto): ?>
            <?php $prodotti = $dbh->getProdottiInAcquisto($acquisto["codice"]); ?>
            <?php $len = count($prodotti); ?>
            <tr>
                <td rowspan=<?php echo $len; ?> ><?php echo $acquisto["data"]; ?></td>
                <td><?php echo $prodotti[0]["nomeFungo"]; ?></td>
                <td><?php echo $prodotti[0]["quantità"]; ?></td>
                <td rowspan=<?php echo $len; ?> ><?php echo $acquisto["totale"]; ?> €</td>
            </tr>
            <?php for($i = 1; $i < $len; $i = $i + 1):?>
            <tr>
                <td><?php echo $prodotti[$i]["nomeFungo"]; ?></td>
                <td><?php echo $prodotti[$i]["quantità"]; ?></td>
            </tr>
            <?php endfor;?>
        <?php endforeach; ?>
        </tbody>
    
    </table>
</div>
<?php endif; ?>

<?php if($acquisti == NULL): ?>
<div class="text-center">Nessun acquisto trovato</div>
<?php endif; ?>
<?php
// require("../bootstrap.php");
//require("/xampp/htdocs/tecnologieWeb2021---E-Commerce/Website/bootstrap.php");
if (!isUserLoggedIn()) {
    die();
}
$acquisti = $dbh->getAcquisti();
?>

<h2 class="text-center py-2">Acquisti passati</h2>

<list>
    <?php if($acquisti != NULL): ?>
    <table class="table text-center table-sm">
        <thead class="table-light">
            <th>Data</th>
            <th>Fungo</th>
            <th>Quantità</th>
            <th>Totale</th>
        </thead>
        
    
        <?php foreach($acquisti as $acquisto): ?>
        <tbody>
            <td><?php echo $acquisto["data"]; ?></th>
            <td><?php echo $acquisto["nomeFungo"]; ?></th>
            <td><?php echo $acquisto["quantità"]; ?></th>
            <td><?php echo $acquisto["totale"]; ?> €</th>
        </tbody>
        <?php endforeach; ?>
    
    </table>
    <?php endif; ?>

    <?php if($acquisti == NULL): ?>
        <div class="text-center">Nessun acquisto trovato</div>
    <?php endif; ?>
    
</list>
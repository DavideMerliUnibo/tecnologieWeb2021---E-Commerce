<?php
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt'); // valid extensions
$path = 'upload/'; // upload directory
if ($_FILES['image']) {
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    // check's valid format
    if (in_array($ext, $valid_extensions)) {
        $path = $path . strtolower($img);
        if (move_uploaded_file($tmp, $path)) {
            require("bootstrap.php");
            if(isset($_POST["titolo"])){
                $dbh->insertImageToRecipe($img,$_POST["titolo"]);
                header('location: http://localhost/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=gestisciRicette');
            } else if (isset($_POST["codProdotto"])){
                $dbh->insertImgToProduct($img,$_POST["codProdotto"]);
                header('location: http://localhost/tecnologieWeb2021---E-Commerce/Website/home-utente.php?action=gestisciRicette');
            }
            
        }
    } else {
        echo 'invalid';
        return;
    }
}
?>
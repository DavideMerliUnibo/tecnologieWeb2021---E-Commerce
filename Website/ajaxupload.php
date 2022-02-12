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
            header("Location: http://localhost/tecnologieWeb2021---E-Commerce/Website/home-utente.php");
        }
    } else {
        echo 'invalid';
    }
}

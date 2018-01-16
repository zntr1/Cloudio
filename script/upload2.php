<?php
/**
 * Created by IntelliJ IDEA.
 * User: p.pradzinski
 * Date: 16.01.2018
 * Time: 09:15
 */


$userName = $_SESSION['userName'];
$path = '../userData/' . $userName;
$uploadDir = $path;

if (!empty($_FILES)) {
    $tmpFile = $_FILES['file']['tmp_name'];
    $filename = $path.'/'. $_FILES['file']['name'];
    move_uploaded_file($tmpFile,$filename);
}


?>
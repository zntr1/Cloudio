<?php
session_start();
$userName = $_SESSION['userName'];
$path = '../userData/' . $userName . '/';
$target_file = $path.basename($_FILES["fileToUpload"]["name"]);
$uploadOk = true;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, datei existiert bereits.";
        $uploadOk = false;
    }
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, datei ist zu groß.";
        $uploadOk = false;
    }
    if (!$uploadOk) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
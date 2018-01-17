<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 14.01.2018
 * Time: 19:36
 */
require_once '../script/dbConfig.php';

$userName = $_SESSION['userName'];
$path = '../userData/' . $userName . '/';
$file = basename($_GET['file']);

if(!$file){ // file does not exist
    die('file not found');
} else {
    // delete the file from disk
    $dbFunction->deleteFile($file);
    unlink($path.$file);
    header("location: ../public/downloadPage.php");
}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 14.01.2018
 * Time: 19:36
 */
session_start();
$userName = $_SESSION['userName'];
$path = '../userData/' . $userName . '/';
$file = basename($_GET['file']);
$contentType = mime_content_type($path . $file);

if (!$file) { // file does not exist
    die('file not found');
} else {
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Type: $contentType");
    header("Content-Transfer-Encoding: binary");

    // read the file from disk
    readfile($path . $file);
}
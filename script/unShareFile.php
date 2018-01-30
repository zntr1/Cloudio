<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 18.01.2018
 * Time: 11:12
 */

require_once '../script/dbConfig.php';

$fileId = $_GET['fileId'];
$username = $_GET['username'];
$dbFunction->deleteSharePropertyFromZTab($fileId,$username);

header('Location: ../public/sharedFiles.php');
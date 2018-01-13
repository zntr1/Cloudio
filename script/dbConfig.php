<?php

/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 08.01.2018
 * Time: 10:05
 */

//Datenbank Connection // erzeugt Datenbankfunktionsobjekt was überall verwendet werden kann
require_once('config.php');

try {
    $DB_con = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch
(PDOException $e) {
    echo $e->getMessage();
}
include_once 'dbFunction.php';
$dbFunction = new dbFunction($DB_con);
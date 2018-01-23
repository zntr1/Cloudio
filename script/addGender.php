<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 15.01.2018
 * Time: 12:54
 */
require_once '../script/dbConfig.php';
$test = isset($_GET['addGender']) === true;
$test3= $test;
if (isset($_GET['addGender']) === true) {
    $dbFunction->addGender($_GET['addGender']);
}
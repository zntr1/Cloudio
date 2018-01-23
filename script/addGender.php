<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 15.01.2018
 * Time: 12:54
 */
require_once '../script/dbConfig.php';


if (isset($_GET['addGender']) && $_GET('addGender') !== '') {
    $dbFunction->addGender($_GET['addGender']);
}
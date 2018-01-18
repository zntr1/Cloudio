<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 17.01.2018
 * Time: 20:22
 */
require_once 'dbConfig.php';

if(isset($_POST["shareUser"])) {
    $dbFunction->shareFile($_POST["shareUser"],$_POST["fileName"]);
}
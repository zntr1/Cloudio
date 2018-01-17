<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 08.01.2018
 * Time: 11:18
 */

require_once '../script/dbConfig.php';


if (isset($_POST['username']) && isset($_POST['password'])) {
    $dbFunction->userLogin($_POST['username'], $_POST['password']);

}
?>
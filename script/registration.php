<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 08.01.2018
 * Time: 20:14
 */

require_once '../script/dbConfig.php';

if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['username']) && isset($_POST['firstName']) && isset($_POST['password']) && isset($_POST['submitPassword']) && isset($_POST['email']) && isset($_POST['plz']) && isset($_POST['birthday']) && isset($_POST['address']) && isset($_POST['gender'])) {
    if ($_POST['password'] === $_POST['submitPassword'])
        $dbFunction->userRegister($_POST['username'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], $_POST['address'], $_POST['birthday'], $_POST['gender'], $_POST['plz']);
}


?>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 16.01.2018
 * Time: 11:05
 */

require_once '../script/dbConfig.php';

if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['oldPassword']) && isset($_POST['email']) && isset($_POST['plz']) && isset($_POST['address']) && isset($_POST['gender'])) {
    $dbFunction->updateUserData($_POST['oldPassword'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['address'], $_POST['plz'], $_POST['gender']);
}
if (isset($_POST['oldPassword']) && isset($_POST['newPassword']) && isset($_POST['submitNewPassword'])&& $_POST['newPassword'] !== '') {
    $dbFunction->updatePassword($_POST['oldPassword'], $_POST['newPassword']);
}
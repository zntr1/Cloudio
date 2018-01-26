<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 16.01.2018
 * Time: 11:05
 */

require_once '../script/dbConfig.php';

if (isset($_POST['settings_firstName']) && isset($_POST['settings_surName']) && isset($_POST['settings_oldPassword']) && isset($_POST['settings_email']) && isset($_POST['settings_plz']) && isset($_POST['settings_address']) && isset($_POST['settings_gender'])) {
    $dbFunction->updateUserData($_POST['settings_oldPassword'], $_POST['settings_firstName'], $_POST['settings_surName'], $_POST['settings_email'], $_POST['settings_address'], $_POST['settings_plz'], $_POST['settings_gender']);
}
if (isset($_POST['settings_oldPassword']) && isset($_POST['settings_password']) && isset($_POST['settings_password2']) && $_POST['settings_password'] !== '') {
    $dbFunction->updatePassword($_POST['settings_oldPassword'], $_POST['settings_password']);
}

header('Location: ../public/userSettingsPage.php');
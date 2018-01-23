<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 23.01.2018
 * Time: 08:36
 */
require_once '../../script/dbConfig.php';

$response = array(
    'valid' => false,
    'message' => 'Bitte eine Email eingeben'
);

if (isset($_POST['email'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $response = array('valid' => false, 'message' => 'Die Email entspricht keinem gültigen E-Mail format');
    } else {
        $email = $dbFunction->checkMail($_POST['email']);
        if (!$email) {
            $response = array('valid' => false, 'message' => 'Die Email wurde bereits vergeben! <a href="../../public/login.php">Einloggen?</a>');
        } else {
            $response = array('valid' => true);
        }
    }
}
echo json_encode($response);
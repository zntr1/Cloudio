<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 23.01.2018
 * Time: 08:14
 */
require_once '../../script/dbConfig.php';

$response = array(
    'valid' => false,
    'message' => 'Bitte eine Postleitzahl eingeben'
);

if (isset($_POST['plz'])) {
    $plz = $dbFunction->checkPostalCode($_POST['plz']);

    if ($plz) {
        $response = array('valid' => false, 'message' => 'Die eingegebene Postleitzahl ist nicht gültig');
    } else {
        $response = array('valid' => true);
    }
}
echo json_encode($response);
<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 23.01.2018
 * Time: 08:26
 */
require_once '../../script/dbConfig.php';

$response = array(
    'valid' => false,
    'message' => 'Bitte einen Benutzernamen eingeben'
);

if (isset($_POST['username'])) {
    $username = $dbFunction->checkUserName($_POST['username']);

    if ($username) {
        $response = array('valid' => false, 'message' => 'Der Benutzername ist schon vergeben');
    } else {
        if(mb_strlen($_POST['username'],'utf8') > 15) {
            $stringCount = mb_strlen($_POST['username'],'utf8')-15;
            $response = array('valid' => false, 'message' => 'Die eingegebene Benutzername ist um '.$stringCount.' Zeichen zu lang.');
        } else if(mb_strlen($_POST['username'],'utf8') < 2) {
            $response = array('valid' => false, 'message' => 'Der Benutzername muss mindestens 2 Zeichen haben');
        } else {
            $response = array('valid' => true);
        }
    }
}
echo json_encode($response);
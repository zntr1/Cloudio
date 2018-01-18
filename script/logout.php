<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 14.01.2018
 * Time: 19:58
 */
setcookie("sessionId", "", time() - 100, "/");
setcookie("username", "", time() - 100, "/");

session_start();
session_destroy();
$login_url = '../public/login.php';
header('Location: ' . $login_url);
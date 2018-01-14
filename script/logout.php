<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 14.01.2018
 * Time: 19:58
 */

session_start();
session_destroy();
$home_url = '../public/login.html';
header('Location: ' . $home_url);
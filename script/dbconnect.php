<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 08.01.2018
 * Time: 10:05
 */

$db = mysqli_connect("localhost", "root", "", "cloudia");
if(!$db)
{
    exit("Verbindungsfehler: ".mysqli_connect_error());
}
?>
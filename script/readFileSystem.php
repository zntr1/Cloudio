<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 15.01.2018
 * Time: 08:24
 */
session_start();
// Schleife über alle Dateien im Ordner
function readFileSystem()
{
    $userName = $_SESSION['userName'];
    if ($folder = opendir('../userData/' . $userName . '/')) {
        while (false !== ($entry = readdir($folder))) {
            if ($entry != "." && $entry != "..") {
                echo "<li><a href='../script/download.php?file=" . $entry . "'>" . $entry . "</a></li>\n";
            }
        }
        closedir($folder);
    }
}

?>
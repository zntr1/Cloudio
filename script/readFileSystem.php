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
    $counter = 1;
    $userName = $_SESSION['userName'];
    $path = '../userData/' . $userName . '/';
    if ($folder = opendir('../userData/' . $userName . '/')) {
        while (false !== ($entry = readdir($folder))) {
            if ($entry != "." && $entry != "..") {
                clearstatcache();
                $date = date("d.m.Y H:i:s", filemtime($path . $entry));
                echo "<tr><td>$counter</td><td><a href='../script/download.php?file=$entry'>$entry</a></td><td>$date</td><td>$userName</td><td><a href='../script/deleteFile.php?file=$entry'>Löschen</a></td></tr>";
                $counter++;
            }

        }
        closedir($folder);
    }
}

?>


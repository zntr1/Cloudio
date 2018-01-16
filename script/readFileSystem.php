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
    if ($folder = opendir('../userData/' . $userName . '/')) {
        while (false !== ($entry = readdir($folder))) {
            if ($entry != "." && $entry != "..") {
                echo "<tr><td>$counter</td><td>$entry</td></tr>";
//                echo "<li><a href='../script/download.php?file=" . $entry . "'>" . $entry . "</a></li>\n";
//                echo "<li class=\"list-group-item list-group-item-dark\"><a class=\"datafileList\" href='../script/download.php?file=" . $entry . "'>" . $entry . "</a></li>";
                $counter++;
            }

        }
        closedir($folder);
    }
}

?>


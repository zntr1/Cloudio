<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 15.01.2018
 * Time: 08:24
 */
session_start();
// Schleife über alle Dateien im Ordner

function formatBytes($bytes)
{
    $precision = 2;
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
}

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

                $size = filesize($path . $entry);
                $size = formatBytes($size);
                echo "<tr>
                        <td>$counter</td>
                        <td><a href='../script/download.php?file=$entry'>$entry</a></td>
                        <td>$date</td>
                        <td>$userName</td>
                        <td>$size</td>
                        <td><a href='../script/deleteFile.php?file=$entry'>Löschen</a></td>
                     </tr>";
                $counter++;
            }

        }
        closedir($folder);
    }
}

?>


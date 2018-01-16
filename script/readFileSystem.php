<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 15.01.2018
 * Time: 08:24
 */

require_once '../script/dbConfig.php';
$fileArray = $dbFunction->getAllowedFiles();
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

// Schleife über alle Dateien im Ordner

function readFileSystem($fileArray)
{
    $foldersUsed = array();
    $files = array($fileArray[0]);
    $folders = array($fileArray[1]);
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
                        <td><a class='fa fa-close fa-lg red' href='../script/deleteFile.php?file=$entry'></a></td>
                     </tr>";
                $counter++;
            }

        }
        closedir($folder);
    }
}

?>


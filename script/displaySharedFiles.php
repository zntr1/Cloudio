<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 18.01.2018
 * Time: 11:05
 */

function displaySharedFiles($fileArray)
{
    $counter = 1;
    foreach ($fileArray as $file) {

        echo "
            <td>$counter</td>
            <td>$file[1]</td>
            <td>$file[0]</td>
            <td><a class='fa fa-close fa-lg red' href='../script/unShareFile.php?fileId=$file[2]&username=$file[0]'></a></td>";
        $counter++;
    }
}
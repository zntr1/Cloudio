<?php
session_start();
// Schleife über alle Dateien im Ordner
$userName = $_SESSION['userName'];
if ($folder = opendir('../userData/' . $userName . '/')) {
    while (false !== ($entry = readdir($folder))) {
        if ($entry != "." && $entry != "..") {
            echo "<a href='../script/download.php?file=". $entry."'>".$entry."</a>\n";
        }
    }
    closedir($folder);
}

?>
<html>
<head>
    <title>Dateisystem</title>
</head>
<body>


</body>

</html>
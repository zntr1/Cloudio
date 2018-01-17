<?php
session_start();

function getFolderSize()
{
    $userName = $_SESSION['userName'];
    $path = '../userData/' . $userName . '/';
    $size = 0;
    $count = 0;
    if ($folder = opendir('../userData/' . $userName . '/')) {
        while (false !== ($entry = readdir($folder))) {
            if ($entry != "." && $entry != "..") {
                $count++;
                $size += filesize($path . $entry);
            }
        }
        $size = formatBytes($size);
    }
    return [$size, $count];
}

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

$totalStats = getFolderSize();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/contentStyles.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <h2>Gesamtupload: <?php echo $totalStats[0] ?></h2>
                <h2>Anzahl Dateien: <?php echo $totalStats[1] ?></h2>

            </div>
        </div>
    </div>
</div>


</body>
</html>
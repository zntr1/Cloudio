<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 18.01.2018
 * Time: 10:21
 */
require_once '../script/dbConfig.php';
require_once '../script/displaySharedFiles.php';


$sharedFiles = $dbFunction->getAllSharedFiles();
$sharedFilesWithName = array();
foreach ($sharedFiles as $file) {
    $userName = $dbFunction->getUsernameByUserId($file[0]['tab_user_userId']);
    $filename = $dbFunction->getFileByFileId($file[0]['tab_file_fileId']);
    $tempArray = [$userName,$filename,$file[0]['tab_file_fileId']];
    array_push($sharedFilesWithName,$tempArray);
}
?>
<html>
<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/contentStyles.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/downloadTable.css">
</head>
<body>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Freigabe</h3>
                      
                    </div>
                    <div class="panel-body">
                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter"
                               data-filters="#dev-table" placeholder="Filtere Dateien">
                    </div>
                    <table class="table table-hover" id="dev-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Dateiname</th>
                            <th>Freigegeben für</th>
                            <th>Freigabe entfernen</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        displaySharedFiles($sharedFilesWithName);
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
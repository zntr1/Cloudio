<?php
require_once '../script/readFileSystem.php';
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
                        <h3 class="panel-title">Dateien</h3>
                        <div class="pull-right">
							<span class="clickable filter" data-toggle="tooltip" title="" data-container="body"
                                  data-original-title="Toggle table filter">
								<i class="fa fa-filter"></i>
							</span>
                        </div>
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
                            <th>Hochgeladen</th>
                            <th>Ersteller</th>
                            <th>Größe</th>
                            <th>Löschen</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        readFileSystem();
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
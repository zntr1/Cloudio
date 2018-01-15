<?php
require_once '../script/readFileSystem.php';
?>
<html>
<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/contentStyles.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul>
                    <?php
                    readFileSystem();
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>

</html>
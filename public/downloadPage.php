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
<ul>
    <?php
        readFileSystem();
    ?>
</ul>

</body>

</html>
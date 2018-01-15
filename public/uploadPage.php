<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/contentStyles.css">
    <link rel="stylesheet" href="../css/styles.css"></head>

<body>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="../script/upload.php" method="post" enctype="multipart/form-data">
                    Datei zum hochladen:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" value="Hochladen" name="submit">
                </form>
            </div>
        </div>
    </div>
</div>


</body>
</html>
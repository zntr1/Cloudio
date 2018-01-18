<!DOCTYPE html>
<html>
<head>
    <script src="../jquery-1.7.1.js"></script>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/contentStyles.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

</head>

<body>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2> Dateien zum hochladen ins Feld ziehen!</h2>
                <form action="../script/upload2.php" enctype="multipart/form-data" class="dropzone black" id="imageUpload">
                    <div class="dz-message" data-dz-message><span style="opacity: 0.5;">Zieh was in mich rein!</span></div>

                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

        Dropzone.options.imageUpload = {
        maxFilesize: 1000, //mb
    };
</script>
<script>


</script>
</body>
</html>
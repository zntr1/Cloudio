<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 08.01.2018
 * Time: 11:18
 */

require_once '../script/dbConfig.php';

$userNamePasswordError = "";
if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($dbFunction->userLogin($_POST['username'], $_POST['password'])) {
        header("location: ../public/index.html");
    } else {
        $userNamePasswordError = "Benutzername oder Passwort nicht korrekt";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

</head>

<body>
<body class="align">
<div class="container">
    <div class="row">
        <div class="registrationDiv">
            <H5 class="text--center" style="font-size: 40px; margin: 0;"> CLOUDIO LOGO </H5>
            <form action="login.php" method="POST" class="form login" id="loginForm">
                <div class="input-group">
                    <span class="input-group-addon"><span class="fa fa-user fa-lg"></span></span>
                    <input id="login__username" type="text" name="username" class="form-control"
                           placeholder="Benutzername" required>
                </div>

                <div class="input-group">
                    <span class="input-group-addon"><span class=" fa fa-lock fa-lg"></span></span>
                    <input id="login__password" type="password" name="password" class="form-control"
                           placeholder="Passwort" required>
                </div>
                <span class="text--center long" style="color:red;"><?php echo $userNamePasswordError; ?></span>

                <div class="unten">
                    <div class="input-group">
                        <input type="submit" value="Einloggen!">
                    </div>
                    <p class="text--center">Noch keinen Account? &nbsp;&nbsp;<a style="color: orange;"
                                                                                href="../public/register.php">Registriere
                            dich
                            kostenlos! &nbsp;<i class="fa fa-sign-in fa-lg"></i> </a>

                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>


</body>


</body>
</html>

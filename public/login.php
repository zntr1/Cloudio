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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

    <link rel="stylesheet" href="../css/contentStyles.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
<body class="align">

<H5 style="font-size: 40px; margin: 0;"> CLOUDIO LOGO </H5>
<span><?php echo $userNamePasswordError;?></span>
<form action="login.php" method="POST" class="form login" id="loginForm">

    <div class="form__field">
        <label for="login__username">
            <i class="fa fa-user fa-lg"></i>
        </label>
        <input id="login__username" type="text" name="username" class="form__input" placeholder="Benutzername">
    </div>

    <div class="form__field">
        <label for="login__password">
            <i class="fa fa-lock fa-lg"></i>
        </label>
        <input id="login__password" type="password" name="password" class="form__input" placeholder="Passwort">
    </div>


    <div class="unten">
        <div class="form__field">
            <input type="submit" value="Einloggen!">
        </div>
        <p class="text--center">Noch keinen Account? &nbsp;&nbsp;<a style="color: orange;"
                                                                    href="../public/register.php">Registriere dich
                kostenlos! &nbsp;<i class="fa fa-sign-in fa-lg"></i> </a>

        </p>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<script src="js/validate-login.js"></script>


</body>


</body>
</html>

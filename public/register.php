<?php
require_once '../script/dbConfig.php';

$test = "";
$emailAlreadyExistError = "";
$userNameAlreadyExistError = "";
$postalCodeNotFoundError = "";
if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['username']) && isset($_POST['firstName']) && isset($_POST['password']) && isset($_POST['submitPassword']) && isset($_POST['email']) && isset($_POST['plz']) && isset($_POST['birthday']) && isset($_POST['address']) && isset($_POST['gender'])) {
    if ($_POST['password'] === $_POST['submitPassword']) {
        if (!$dbFunction->checkMail($_POST['email'])) {
            $emailAlreadyExistError = "Email existiert bereits!";
        } else if (!$dbFunction->checkUserName($_POST['username'])) {
            $userNameAlreadyExistError = "Benutzername schon vergeben";
        } else if(!$dbFunction->checkPostalCode($_POST['plz'])) {
            $postalCodeNotFoundError = "Postleitzahl nicht gefunden";
        } else {
            $dbFunction->userRegister($_POST['username'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], $_POST['address'], $_POST['birthday'], $_POST['gender'], $_POST['plz']);
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrierung</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">

    <!--    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">-->

    <!--    <link rel="stylesheet" href="../css/contentStyles.css">-->
    <!--    <link rel="stylesheet" href="../css/styles.css">-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/registration.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>



    <!--    <script src="../jquery.form-validator.min.js"></script>-->


</head>

<body class="align">
<div id="content">
    <div class="container">
        <div class="row">
            <div class="registrationDiv">
                <H5 class="text--center" style="font-size: 40px; margin: 0;"> CLOUDIO LOGO HIER EINFÜGEN</H5>


                <form action="../script/registration.php" method="POST" class="form login">

                    <div class="links">


                        <div class="input-group">
                            <span class="input-group-addon"><span class=" fa fa-user fa-lg"></span></span>
                            <input id="registration_username" type="text" name="username" class="form-control"
                                   placeholder="Benutzername" data-validation="alphanumeric"
                                   data-validation-allowing="-_" data-validation-length="5-15"
                                   required>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon "><span class="fa fa-id-card fa-lg"></span></span>
                            <input id="registration_firstName" type="text" name="firstName" class="form-control"
                                   placeholder="Vorname" data-validation="length" data-validation-length="min1"
                                   required>
                        </div>


                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-id-card fa-lg"></span></span>
                            <input id="registration_surName" type="text" name="lastName" class="form-control"
                                   placeholder="Nachname" data-validation="length" data-validation-length="min1"
                                   required>
                        </div>


                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-lock fa-lg"></span></span>
                            <input id="registration_password" type="password" name="password" class="form-control"
                                   placeholder="Passwort" data-validation="strength" data-validation-strength="2"
                                   required>
                        </div>


                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-lock fa-lg"></span></span>
                            <input id="registration_password2" type="password" name="submitPassword"
                                   class="form-control" placeholder="Passwort wiederholen"
                                   data-validation="confirmation"  data-validation-confirm="password"
                                   required>
                        </div>

                        <div class="g-recaptcha captcha" data-sitekey="6LeWYEEUAAAAAMC4EhCyqA5j5AYFkusY9pdGpQqs">
<!--                            <input styledata-validation="recaptcha" data-sitekey="6LeWYEEUAAAAAMC4EhCyqA5j5AYFkusY9pdGpQqs" data-validation-recaptcha-sitekey="6LeWYEEUAAAAAMC4EhCyqA5j5AYFkusY9pdGpQqs">-->

                        </div>


                    </div>

                    <div class="rechts">

                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-at fa-lg"></span></span>
                            <input id="registration_email" type="email" name="email" class="form-control"
                                   placeholder="E-Mail" required>
                        </div>


                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-home fa-lg"></span></span>
                            <input id="registration_plz" type="text" name="plz" class="form-control"
                                   placeholder="Postleitzahl" data-validation="alphanumeric" data-validation-length="1-10"required>
                        </div>


                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-road fa-lg"></span></span>
                            <input id="registration_address" type="text" name="address" class="form-control"
                                   placeholder="Straße" data-validation="alphanumeric" data-validation-allowing="-_. " data-validation-length="2-50"
                                   required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-birthday-cake fa-lg"></span></span>
                            <input id="registration_birthday" value="1939-05-30" type="date" name="birthday"
                                   class="form-control"
                                   placeholder="Geburtsdatum"
                                   required>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-android fa-lg"></span></span>
                            <select class="form-control" name="gender" value="Joghurt" title="Geschlecht">
                                <option selected>Dobby</option>
                                <?php
                                echo $dbFunction->getGenderData($actualGender);
                                ?>
                            </select>
                        </div>
                        <a href="javascript:changeShowAddGenderVisibility();" id="addGenderHref">Ihr Geschlecht ist nicht dabei? Jetzt Geschlecht hinzufügen</a>
                        <div class="input-group genderText" id="addGenderContainer" style="display:none">
<!--                            <input id="btn_addGender" value="+" type="button" name="btn_addGender" class="form-control" placeholder="+" onclick="alert('Lol I Bims');"required="">-->
                            <a href="" onclick="openPhpScript()" id="addGenderGetRequest"><span class="input-group-addon"><i class="fa fa-plus fa-lg"></i></span></a>
                            <input id="text_addGender" value="" type="text" name="text_addGender" class="form-control genderText" placeholder="Neues Geschlecht eingeben" required="">
<!--                            <a><i class="fa fa-plus fa-2x" aria-hidden="true"></i></a>-->

                        </div>
                    </div>

                    <div class="">
                            <div class="">
                                <input type="submit" value="Registrieren" class="form-control">
                            </div>

                        <p class="text--center">Schon registriert? &nbsp;&nbsp;<a style="color: orange;"
                                                                                  href="../public/login.php">Logge
                                dich ein! &nbsp;<i class="fa fa-sign-in fa-lg"></i> </a>

                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $.validate({
        reCaptchaSiteKey: '6LeWYEEUAAAAAMC4EhCyqA5j5AYFkusY9pdGpQqs',
        reCaptchaTheme: 'dark',
        modules: 'security',
        onModulesLoaded: function () {
            var optionalConfig = {
                fontSize: '12pt',
                padding: '4px',
                width: '100%',
                bad: 'Schlecht',
                weak: 'Schwach',
                good: 'Gut',
                strong: 'Stark'
            };

            $('input[name="password"]').displayPasswordStrength(optionalConfig);
        }
    });
</script>
<script src="js/showAddGender.js"></script>
</body>
</html>

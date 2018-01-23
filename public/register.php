<?php
require_once '../script/dbConfig.php';

$error = "";
$emailAlreadyExistError = "";
$userNameAlreadyExistError = "";
$postalCodeNotFoundError = "";
if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['username']) && isset($_POST['firstName']) && isset($_POST['password']) && isset($_POST['submitPassword']) && isset($_POST['email']) && isset($_POST['plz']) && isset($_POST['birthday']) && isset($_POST['address']) && isset($_POST['gender'])) {
    if ($_POST['password'] === $_POST['submitPassword']) {
        if (!$dbFunction->checkMail($_POST['email'])) {
            $emailAlreadyExistError = "Email existiert bereits!";
        } else if ($dbFunction->checkUserName($_POST['username'])) {
            $userNameAlreadyExistError = "Benutzername schon vergeben";
        } else if ($dbFunction->checkPostalCode($_POST['plz'])) {
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/registration.css">

</head>

<body class="align">
<div id="content">
    <div class="container">
        <div class="row">
            <div class="registrationDiv">
                <H5 class="text--center" style="font-size: 40px; margin: 0;"> CLOUDIO LOGO HIER EINFÜGEN</H5>

                <form action="register.php" method="POST" class="form login" novalidate>

                    <div class="links">

                        <div class="input-group">
                            <span class="input-group-addon"><span class=" fa fa-user fa-lg"></span></span>
                            <input id="registration_username" type="text" name="username" class="form-control"
                                   placeholder="Benutzername" data-validation="server"
                                   data-validation-url="../script/validation/validate-username.php">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon "><span class="fa fa-id-card fa-lg"></span></span>
                            <input id="registration_firstName" type="text" name="firstName" class="form-control"
                                   placeholder="Vorname" data-validation="length" data-validation-length="min1"
                                   data-validation-error-msg="Bitte einen Vornamen eingeben"
                                   required>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-id-card fa-lg"></span></span>
                            <input id="registration_surName" type="text" name="lastName" class="form-control"
                                   placeholder="Nachname" data-validation="length" data-validation-length="min1"
                                   data-validation-error-msg="Bitte einen Nachnamen eingeben"
                                   required>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-lock fa-lg"></span></span>
                            <input id="registration_password" type="password" name="password" class="form-control"
                                   placeholder="Passwort" data-validation="strength" data-validation-strength="2"
                                   required
                                   data-validation-error-msg="Ihr Passwort muss einen Groß- und Kleinbuchstaben, eine Zahl und ein Sonderzeichen enthalten">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-lock fa-lg"></span></span>
                            <input id="registration_password2" type="password" name="submitPassword"
                                   class="form-control" placeholder="Passwort wiederholen"
                                   data-validation="confirmation" data-validation-confirm="password"
                                   data-validation-error-msg="Das Passwort muss mit dem oben genannten Passwort übereinstimmen"
                                   required>
                        </div>
                        <div class="g-recaptcha captcha" data-sitekey="6LeWYEEUAAAAAMC4EhCyqA5j5AYFkusY9pdGpQqs"></div>
                    </div>

                    <div class="rechts">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-at fa-lg"></span></span>
                            <input id="registration_email" type="text" data-validation="server" name="email"
                                   class="form-control"
                                   placeholder="E-Mail" data-validation-url="../script/validation/validate-email.php">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-home fa-lg"></span></span>
                            <input id="registration_plz" type="text" name="plz" class="form-control"
                                   placeholder="Postleitzahl" data-validation="server"
                                   data-validation-url="../script/validation/validate-plz.php">
                        </div>


                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-road fa-lg"></span></span>
                            <input id="registration_address" type="text" name="address" class="form-control"
                                   placeholder="Straße" data-validation="alphanumeric" data-validation-allowing="-_. "
                                   data-validation-length="2-50"
                                   data-validation-error-msg="Bitte geben Sie eine gültige Straße an!"
                                   required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-birthday-cake fa-lg"></span></span>
                            <input id="registration_birthday" type="date" name="birthday"
                                   class="form-control"
                                   placeholder="Geburtsdatum"
                                   required data-validation-error-msg="Bitte geben Sie ein Geburtsdatum an">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-android fa-lg"></span></span>
                            <select class="form-control" name="gender" title="Geschlecht">
                                <?php
                                echo $dbFunction->getGenderData("");
                                ?>
                            </select>
                        </div>
                        <a href="javascript:changeShowAddGenderVisibility();" id="addGenderHref">Ihr Geschlecht ist
                            nicht dabei? Jetzt Geschlecht hinzufügen</a>
                        <div class="input-group" id="addGenderContainer" style="display:none">
                            <a href="" onclick="openPhpScript()" id="addGenderGetRequest"><span
                                        class="input-group-addon"><i class="fa fa-plus fa-lg"></i></span></a>
                            <input id="text_addGender" value="" type="text" name="text_addGender"
                                   class="form-control genderText" placeholder="Neues Geschlecht eingeben">

                        </div>
                    </div>
                    <?php echo $error ?>

                    <div class="">
                        <div class="">
                            <input type="submit" value="Registrieren" class="form-control">
                        </div>

                        <p class="text--center">Schon registriert? &nbsp;&nbsp;<a style="color: orange;"
                                                                                  href="../public/login.php">Logge
                                dich ein! &nbsp;<i class="fa fa-sign-in fa-lg"></i></a>

                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script src="../public/js/showAddGender.js"></script>

<script>
    $.validate({
        reCaptchaSiteKey: '6LeWYEEUAAAAAMC4EhCyqA5j5AYFkusY9pdGpQqs',
        reCaptchaTheme: 'dark',
        modules: 'security, html5',
        onModulesLoaded: function () {
            var optionalConfig = {
                fontSize: '12pt',
                padding: '4px',
                width: '25%',
                bad: 'Schlecht',
                weak: 'Schwach',
                good: 'Gut',
                strong: 'Stark'
            };

            $('input[name="password"]').displayPasswordStrength(optionalConfig);
        }
    });
</script>
</body>
</html>

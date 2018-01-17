<?php
require_once '../script/dbConfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrierung</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

    <link rel="stylesheet" href="../css/contentStyles.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<body class="align">
<H5 style="font-size: 40px; margin: 0;"> CLOUDIO LOGO HIER EINFÜGEN</H5>
<form action="../script/registration.php" method="POST" class="form login">

    <div class="links">
        <div class="form__field">
            <label for="registration_username">
                <i class="fa fa-user fa-lg"></i>
            </label>
            <input id="registration_username" type="text" name="username" class="form__input" placeholder="Benutzername"
                   required>
        </div>


        <div class="form__field">
            <label for="registration_firstName">
                <i class="fa fa-address-card "></i>
            </label>
            <input id="registration_firstName" type="text" name="firstName" class="form__input" placeholder="Vorname"
                   required>
        </div>


        <div class="form__field">
            <label for="registration_surName">
            </label>
            <input id="registration_surName" type="text" name="lastName" class="form__input" placeholder="Nachname"
                   required>
        </div>


        <div class="form__field">
            <label for="registration_password">
                <i class="fa fa-lock fa-lg"></i>
            </label>
            <input id="registration_password" type="password" name="password" class="form__input" placeholder="Passwort"
                   required>
        </div>


        <div class="form__field">
            <label for="registration_password2">k
            </label>
            <input id="registration_password2" type="password" name="submitPassword" class="form__input"
                   placeholder="Passwort wiederholen"
                   required>
        </div>

    </div>

    <div class="rechts">
        <div class="form__field">
            <label for="registration_email">
                <i class="fa fa-at fa-lg"></i>
            </label>
            <input id="registration_email" type="email" name="email" class="form__input" placeholder="E-Mail" required>
        </div>


        <div class="form__field">
            <label for="registration_plz">
                <i class="fa fa-map fa-lg"></i>
            </label>
            <input id="registration_plz" type="text" name="plz" class="form__input" placeholder="Postleitzahl" required>
        </div>


        <div class="form__field">
            <label for="registration_address">
                <i class="fa fa-home fa-lg"></i>
            </label>
            <input id="registration_address" type="text" name="address" class="form__input" placeholder="Straße"
                   required>
        </div>
        <div class="form__field">
            <label for="registration_birthday">
                <i class="fa fa-birthday-cake fa-lg"></i>
            </label>
            <input id="registration_birthday" value="1939-05-30" type="date" name="birthday" class="form__input" placeholder="Geburtsdatum"
                   required>
        </div>

        <div class="form__field">
            <label for="registration_gender">
                <i class="fa fa-android fa-lg"></i>
            </label>
            <select class="selectpicker" name="gender" value="Joghurt" title="Geschlecht">
                <option selected >Dobby</option>
                <?php
                echo $dbFunction->getGenderData($actualGender);
                ?>
            </select>
        </div>
    </div>
<div class="unten">
    <div class="form__field">
        <input type="submit" value="Registrieren">
    </div>

    <p class="text--center">Schon registriert? &nbsp;&nbsp;<a style="color: orange;" href="../public/login.html">Logge dich ein! &nbsp;<i class="fa fa-sign-in fa-lg"></i> </a>

    </p>
</div>
</form>




</body>


</body>
</html>

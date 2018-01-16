<?php
require_once '../script/dbConfig.php';
$userData = $dbFunction->getUserDataForSettings();
$actualGender = $dbFunction->getGenderById($userData['genderId']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>


<form action="../script/userSetting.php" method="POST" class="form settings">

    <div class="form__field">
        <label for="settings_firstName">
            <svg class="icon">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
            </svg>
            <span class="hidden">Vorname</span></label>
        <input id="settings_firstName" type="text" name="firstName" class="form__input"
               value="<?php echo $userData['firstName']; ?>"
               required>
    </div>
    <div class="form__field">
        <label for="settings_surName">
            <svg class="icon">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
            </svg>
            <span class="hidden">Nachname</span></label>
        <input id="settings_surName" type="text" name="lastName" class="form__input"
               value="<?php echo $userData['lastName']; ?>"
               required>
    </div>

    <div class="form__field">
        <label for="settings_new_password">
            <svg class="icon">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use>
            </svg>
            <span class="hidden">Passwort</span></label>
        <input id="settings_new_password" type="password" name="newPassword" class="form__input"
               placeholder="Neues Passwort">
    </div>

    <div class="form__field">
        <label for="settings_password2">
            <svg class="icon">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use>
            </svg>
            <span class="hidden">Neues Passwort bestätigen</span></label>
        <input id="registration_password2" type="password" name="submitNewPassword" class="form__input"
               placeholder="Neues Passwort bestätigen">
    </div>
    <div class="form__field">
        <label for="settings_email">
            <svg class="icon">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
            </svg>
            <span class="hidden">Email</span></label>
        <input id="settings_email" name="email" class="form__input" value="<?php echo $userData['email']; ?>" required>
    </div>
    <div class="form__field">
        <label for="settings_plz">
            <svg class="icon">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
            </svg>
            <span class="hidden">Postleitzahl</span></label>
        <input id="settings_plz" type="text" name="plz" class="form__input"
               value="<?php echo $userData['postalcode']; ?>" required>
    </div>
    <div class="form__field">
        <label for="settings_address">
            <svg class="icon">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use>
            </svg>
            <span class="hidden">Adresse</span></label>
        <input id="settings_address" type="text" name="address" class="form__input"
               value="<?php echo $userData['address']; ?>"
               required>
    </div>

    <div class="form__field">
        <label for="registration_gender">
            <svg class="icon">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use>
            </svg>
            <span class="hidden">Geschlecht</span></label>
        <select class="selectpicker" name="gender" title="Geschlecht">
            <option><?php echo $actualGender ?></option>
            <?php
            echo $dbFunction->getGenderData($actualGender);
            ?>
        </select>
    </div>

    <div class="form__field">
        <label for="settings_old_password">
            <svg class="icon">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use>
            </svg>
            <span class="hidden">Passwort</span></label>
        <input id="settings_old_password" type="password" name="oldPassword" class="form__input"
               placeholder="Altes Passwort"
               required>
    </div>
    <div class="form__field">
        <input type="submit" value="Daten Ändern">
    </div>
</form>

</body>
</html>
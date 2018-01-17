<?php
require_once '../script/dbConfig.php';
$userData = $dbFunction->getUserDataForSettings();
$actualGender = $dbFunction->getGenderById($userData['genderId']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/contentStyles.css">
    <link rel="stylesheet" href="../css/styles.css">

</head>
<body>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="../script/userSetting.php" method="POST">
                    <!--// Vorname-->
                    <div class="form-group">
                        <label for="settings_firstName">Vorname</label>
                        <input id="settings_firstName" type="text" name="firstName" class="form-control"
                               placeholder="Vorname eintragen.."
                               value="<?php echo $userData['firstName']; ?>"
                               required>
                    </div>

                    <!--    // Nachname-->
                    <div class="form-group">
                        <label for="settings_surName">Nachname</label>
                        <input id="settings_surName" type="text" name="lastName" class="form-control"
                               placeholder="Nachname eintragen.."
                               value="<?php echo $userData['lastName']; ?>"
                               required>
                    </div>

                    <!--   // Aktuelles Passwort-->
                    <div class="form-group">
                        <label for="settings_old_password">Aktuelles Passwort</label>
                        <input id="settings_old_password" type="password" name="oldPassword" class="form-control"
                               placeholder="Aktuelles Passwort.."
                               value="" required>
                    </div>

                    <!--   // Passwort-->
                    <div class="form-group">
                        <label for="settings_new_password">Neues Passwort</label>
                        <input id="settings_new_password" type="password" name="newPassword" class="form-control"
                               placeholder="Passwort ändern.."
                               value="">
                    </div>

                    <!--      // Passwort 2-->
                    <div class="form-group">
                        <label for="settings_password2">Passwort wiederholen</label>
                        <input id="settings_password2" type="password" name="submitNewPassword" class="form-control"
                               placeholder="Passwort wiederholen.."
                               value="">
                    </div>

                    <!--     Email-->
                    <div class="form-group">
                        <label for="settings_email">Email</label>
                        <input id="settings_email" type="email" name="email" class="form-control"
                               placeholder="Email ändern"
                               value="<?php echo $userData['email']; ?>" required>
                    </div>


                    <!--   // Adresse-->
                    <div class="form-group">
                        <label for="settings_address">Adresse</label>
                        <input id="settings_address" type="text" name="address" class="form-control"
                               placeholder="Adresse"
                               value="<?php echo $userData['address']; ?>" required>
                    </div>

                    <!--   // PLZ-->
                    <div class="form-group">
                        <label for="settings_plz">Postleitzahl</label>
                        <input id="settings_plz" type="text" name="plz" class="form-control" placeholder="Postleitzahl"
                               value="<?php echo $userData['postalcode']; ?>" required>
                    </div>

                <!-- !!!!!!!!!!!!!!!!!! Gender habe ich rausgelassen, mach aktuellen gender als Option im Picker-->

                    <!--    // Genderpick-->
                    <div class="form-group">
                        <label for="registration_gender">Geschlecht</label>
                        <select id="registration_gender" name="gender" class="form-control"
                                placeholder="Geschlecht auswählen">
                            <option selected><?php echo $actualGender ?></option>
                            <?php
                            echo $dbFunction->getGenderData($actualGender);
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Daten speichern</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
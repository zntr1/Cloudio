<?php
/**
 * Created by IntelliJ IDEA.
 * User: skohlrus
 * Date: 11.01.2018
 * Time: 15:46
 */

session_start();

//Hier sind alle Datenbankfunktionen hinterlegt

class dbFunction
{
    function __construct($dbConnection)
    {
        $this->dbCon = $dbConnection;

    }
//Für die Registrierung braucht man Benutzernamen, Vorname, Nachname, Passwort, E-Mail-Adresse, Adresse, Geschlecht und Geburtsdatum
//	Der Benutzername und die E-Mail-Adresse müssen eindeutig sein
//	Keines der oben genannten Felder soll optional sein
//	Nutzername, Vorname und Nachname sollen eine maximale Länge haben
//	Die E-Mail muss einem E-Mail Regex entsprechen
//	Passwort: mindestens 8 Zeichen, ein Kleinbuchstabe, ein Großbuchstabe eine Zahl und ein Sonderzeichen
//Nach der Registrierung kann man sich einloggen
    public $emailRegex = "";
    public $pwRegex = "";

    public function userLogin($username, $password)
    {
        $statement = $this->dbCon->prepare("SELECT * FROM tab_user WHERE userName = :userName");
        $result = $statement->execute(array('userName' => $username));
        $user = $statement->fetch();

        //check PW
//    if ($user !== false && password_verify($password, $user['password'])) {
        $test = password_verify($password, $user["password"]);
        if ($user !== false && password_verify($password, $user['password'])) {
            $_SESSION['userId'] = $user['userId'];
            $_SESSION['userName'] = $user['userName'];
            header("location: ../public/index.html");
        } else {
            $errorMessage = "E-Mail oder Passwort war ungültig";
            echo($errorMessage);
        }
    }

    public function userRegister($userName, $firstName, $lastName, $email, $password, $address, $birthday, $gender, $postalCode)
    {
        $registerStatement = $this->dbCon->prepare("INSERT INTO tab_user(userName,firstName,lastname,password, email, address, birthday, genderId, postalcode) VALUES (:userName,:firstName,:lastName,:password,:email,:address,:birthday,:genderId,:postalCode)");
        if ($this->checkMail($email) && $this->checkUserName($userName)) {
            $genderFetch = $this->getGenderId($gender);
            $genderId = $genderFetch["genderId"];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $registerStatement->bindParam(':userName', $userName);
            $registerStatement->bindParam(':firstName', $firstName);
            $registerStatement->bindParam(':lastName', $lastName);
            $registerStatement->bindParam(':password', $hashedPassword);
            $registerStatement->bindParam(':email', $email);
            $registerStatement->bindParam(':address', $address);
            $registerStatement->bindParam(':birthday', $birthday);
            $registerStatement->bindParam(':genderId', $genderId);
            $registerStatement->bindParam(':postalCode', $postalCode);
            $registerResult = $registerStatement->execute();
            mkdir("../userData/".$userName, 0700);
        } else {
            return false;
        }
    }

    public function getGenderId($gender)
    {
        $genderIdStatement = $this->dbCon->prepare("SELECT genderId FROM tab_gender WHERE gender = :gender");
        $genderIdStatement->bindParam(':gender', $gender);
        $genderIdResult = $genderIdStatement->execute();
        return $genderIdStatement->fetch($genderIdResult);
    }

    public function checkMail($email)
    {
        $checkMailStatement = $this->dbCon->prepare("SELECT * FROM tab_user where email = :mail");
        $checkMailStatement->bindParam(':mail', $email);
        $checkMailResult = $checkMailStatement->execute();
        $checkMailFetch = $checkMailStatement->fetch($checkMailResult);
        if (!$checkMailFetch) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUserName($userName)
    {
        $checkStatement = $this->dbCon->prepare("SELECT * FROM tab_user where userName = :userName");
        $checkStatement->bindParam(':userName', $userName);
        $checkResult = $checkStatement->execute();
        $checkFetch = $checkStatement->fetch($checkResult);
        if (!$checkFetch) {
            return true;
        } else {
            return false;
        }
    }

    public function getGenderData()
    {
        $options = "";
        $statement = $this->dbCon->prepare("SELECT gender FROM tab_gender");
        $result = $statement->execute();

        while ($row = $statement->fetch($result)) {
            $options = $options . "<option>" . $row['gender'] . "</option>";
        }
        return $options;
    }
}
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
//	Die E-Mail muss einem E-Mail Regex entsprechen
//	Passwort: mindestens 8 Zeichen, ein Kleinbuchstabe, ein Großbuchstabe eine Zahl und ein Sonderzeichen
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
            header("location: ../public/login.html#wrong-login");
//            $errorMessage = "E-Mail oder Passwort war ungültig";
//            echo($errorMessage);
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
            mkdir("../userData/" . $userName, 0700);
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
        $checkUserNameStatement = $this->dbCon->prepare("SELECT * FROM tab_user where userName = :userName");
        $checkUserNameStatement->bindParam(':userName', $userName);
        $checkUserNameResult = $checkUserNameStatement->execute();
        $checkUserNameFetch = $checkUserNameStatement->fetch($checkUserNameResult);
        if (!$checkUserNameFetch) {
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

    public function addGender($gender)
    {
        $addGenderStatement = $this->dbCon->prepare("INSERT INTO tab_gender(gender) VALUES (:gender)");
        if ($this->checkGenderName($gender)) {
            $addGenderStatement->bindParam(':gender', $gender);
            $addGenderResult = $addGenderStatement->execute();
            header("Refresh:0; url=../public/register.php");
        }
    }

    public function checkGenderName($gender)
    {
        $checkGenderStatement = $this->dbCon->prepare("SELECT * FROM tab_gender where gender = :gender");
        $checkGenderStatement->bindParam(':gender', $gender);
        $checkGenderResult = $checkGenderStatement->execute();
        $checkGenderFetch = $checkGenderStatement->fetch($checkGenderResult);
        if (!$checkGenderFetch) {
            return true;
        } else {
            return false;
        }
    }
}
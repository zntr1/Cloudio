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
        $statement->execute(array('userName' => $username));
        $user = $statement->fetch();

        if ($user !== false && password_verify($password, $user['password'])) {
            $folderId = $this->getFolderId($user['userName']);
            $_SESSION['userId'] = $user['userId'];
            $_SESSION['userName'] = $user['userName'];
            $_SESSION['folderId'] = $folderId;
            $sessionId = session_id();
            $date_of_expiry = time() + 3600 * 48;
            setcookie("username", "$username", $date_of_expiry, "/");
            setcookie("sessionId", "$sessionId", $date_of_expiry, "/");
            header("location: ../public/index.html");
            return true;
        } else {
            return false;
        }
    }

    public function userRegister($userName, $firstName, $lastName, $email, $password, $address, $birthday, $gender, $postalCode)
    {
        $registerStatement = $this->dbCon->prepare("INSERT INTO tab_user(userName,firstName,lastname,password, email, address, birthday, genderId, postalcode) VALUES (:userName,:firstName,:lastName,:password,:email,:address,:birthday,:genderId,:postalCode)");
        if ($this->checkMail($email) && !$this->checkUserName($userName)) {
            $genderFetch = $this->getGenderId($gender);
            $genderId = $genderFetch["genderId"];
            $formattedBirthday = strtotime($birthday);
            $formattedBirthday = date("Y-m-d H:i:s", $formattedBirthday);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $registerStatement->bindParam(':userName', $userName);
            $registerStatement->bindParam(':firstName', $firstName);
            $registerStatement->bindParam(':lastName', $lastName);
            $registerStatement->bindParam(':password', $hashedPassword);
            $registerStatement->bindParam(':email', $email);
            $registerStatement->bindParam(':address', $address);
            $registerStatement->bindParam(':birthday', $formattedBirthday);
            $registerStatement->bindParam(':genderId', $genderId);
            $registerStatement->bindParam(':postalCode', $postalCode);
            $registerStatement->execute();
            $this->createFolder($userName);
            mkdir("../userData/" . $userName, 0700);
            $this->userLogin($userName, $password);
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

    public function getFolderId($name)
    {
        $getFolderIdStatement = $this->dbCon->prepare("SELECT folderId FROM tab_folder WHERE foldername = :folder");
        $getFolderIdStatement->bindParam(':folder', $name);
        $getFolderIdResult = $getFolderIdStatement->execute();
        return $getFolderIdStatement->fetch($getFolderIdResult)['folderId'];
    }

    public function getFolderById($id)
    {
        $getFolderByIdStatement = $this->dbCon->prepare("SELECT foldername FROM tab_folder WHERE folderId = :folderId");
        $getFolderByIdStatement->bindParam(':folderId', $id);
        $getFolderByIdResult = $getFolderByIdStatement->execute();
        return $getFolderByIdStatement->fetch($getFolderByIdResult)['foldername'];
    }

    public function createFolder($userName)
    {
        $createFolderStatement = $this->dbCon->prepare("INSERT INTO tab_folder(foldername) VALUES (:foldername)");
        $createFolderStatement->bindParam(':foldername', $userName);
        $createFolderStatement->execute();
    }

    public function createFile($fileName)
    {
        $createFileStatement = $this->dbCon->prepare("INSERT INTO tab_file(filename,parentfolderId) VALUES (:filename,:parentfolderId)");
        $createFileStatement->bindParam(':filename', $fileName);
        $test = $_SESSION['folderId'];
        $createFileStatement->bindParam(':parentfolderId', $test);
        $createFileStatement->execute();
        $fileId = $this->dbCon->lastInsertId();
        $userId = $_SESSION['userId'];
        $createFileUserPropertyStatement = $this->dbCon->prepare("INSERT INTO tab_file_has_tab_user(tab_file_fileId, tab_user_userId) VALUES($fileId,$userId)");
        $createFileUserPropertyStatement->execute();
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

    public function checkPostalCode($postalCode)
    {
        $checkPostalCodeStatement = $this->dbCon->prepare("SELECT * FROM tab_city where postalcode = :postalcode");
        $checkPostalCodeStatement->bindParam(':postalcode', $postalCode);
        $checkPostalCodeResult = $checkPostalCodeStatement->execute();
        $checkPostalCodeFetch = $checkPostalCodeStatement->fetch($checkPostalCodeResult);
        if (!$checkPostalCodeFetch) {
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
        if ($checkUserNameFetch) {
            return true;
        } else {
            return false;
        }
    }

    public function getGenderData($actualGender)
    {
        $options = "";
        $statement = $this->dbCon->prepare("SELECT gender FROM tab_gender");
        $result = $statement->execute();

        while ($row = $statement->fetch($result)) {
            if ($actualGender !== $row['gender']) {
                $options = $options . "<option>" . $row['gender'] . "</option>";
            }
        }
        return $options;
    }

    public function addGender($gender)
    {
        if ($this->checkGenderName($gender)) {

            $addGenderStatement = $this->dbCon->prepare("INSERT INTO tab_gender(gender) VALUES (:gender)");
            if ($this->checkGenderName($gender)) {
                $addGenderStatement->bindParam(':gender', $gender);
                $addGenderStatement->execute();
            }
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

    public function getGenderById($genderId)
    {
        $getGenderIdStatement = $this->dbCon->prepare("SELECT gender FROM tab_gender where genderId = :genderId");
        $getGenderIdStatement->bindParam(':genderId', $genderId);
        $getGenderIdResult = $getGenderIdStatement->execute();
        $getGenderIdFetch = $getGenderIdStatement->fetch($getGenderIdResult);
        return $getGenderIdFetch['gender'];
    }

    public function getUserDataForSettings()
    {
        $userId = $_SESSION['userId'];
        $getUserDataStatement = $this->dbCon->prepare("SELECT firstName,lastName,email,address,postalcode,genderId from tab_user where userId = :userId");
        $getUserDataStatement->bindParam(':userId', $userId);
        $getUserDataResult = $getUserDataStatement->execute();
        $checkGenderFetch = $getUserDataStatement->fetch($getUserDataResult);
        return $checkGenderFetch;
    }

    public function updateUserData($oldPassword, $firstName, $lastName, $email, $address, $postalCode, $gender)
    {
        $userId = $_SESSION['userId'];
        $statement = $this->dbCon->prepare("SELECT * FROM tab_user WHERE userId = :userId");
        $updateUserDataStatement = $this->dbCon->prepare("UPDATE tab_user SET firstName = :firstName, lastName = :lastName,email = :email, address = :address,postalcode = :postalCode, genderId = :genderId WHERE userId = :userId");
        $result = $statement->execute(array('userId' => $userId));
        $user = $statement->fetch();
        if ($user !== false && password_verify($oldPassword, $user['password'])) {
            $genderFetch = $this->getGenderId($gender);
            $genderId = $genderFetch["genderId"];
            $updateUserDataStatement->bindParam(':userId', $userId);
            $updateUserDataStatement->bindParam(':firstName', $firstName);
            $updateUserDataStatement->bindParam(':lastName', $lastName);
            $updateUserDataStatement->bindParam(':email', $email);
            $updateUserDataStatement->bindParam(':address', $address);
            $updateUserDataStatement->bindParam(':genderId', $genderId);
            $updateUserDataStatement->bindParam(':postalCode', $postalCode);
            $updateUserDataStatement->execute();
            header("location: ../public/index.html");
        }
    }

    public function updatePassword($oldPassword, $newPassword)
    {
        $userId = $_SESSION['userId'];
        $statement = $this->dbCon->prepare("SELECT * FROM tab_user WHERE userId = :userId");
        $updatePasswordStatement = $this->dbCon->prepare("UPDATE tab_user SET password = :password WHERE userId = :userId");
        $result = $statement->execute(array('userId' => $userId));
        $user = $statement->fetch();
        if ($user !== false && password_verify($oldPassword, $user['password'])) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updatePasswordStatement->bindParam(':userId', $userId);
            $updatePasswordStatement->bindParam(':password', $hashedPassword);
            $updatePasswordStatement->execute();
            header("location: ../public/index.html");
        }
    }

    public function getAllOwnedFiles()
    {
        $folderId = $_SESSION['folderId'];
        $getFileStatement = $this->dbCon->prepare("SELECT filename,fileId FROM tab_file WHERE parentfolderId = $folderId");
        $getFileStatement->execute();
        $files = $getFileStatement->fetchAll();
        return $files;
    }

    public function getAllSharedFiles()
    {
        $sharedFiles = array();
        $ownedFiles = $this->getAllOwnedFiles();
        $userId = $_SESSION['userId'];
        foreach ($ownedFiles as $file) {
            $fileId = $file['fileId'];
            $getAllSharedFilesStatement = $this->dbCon->prepare("SELECT * FROM tab_file_has_tab_user WHERE tab_file_fileId = $fileId AND tab_user_userId != $userId");
            $getAllSharedFilesStatement->execute();
            $getAllFilesFetch = $getAllSharedFilesStatement->fetchAll();
            if ($getAllFilesFetch) {
                array_push($sharedFiles, $getAllFilesFetch);
            }
        }
        return $sharedFiles;

    }

    public function getAllowedFiles()
    {
        $allFolderNames = array();
        $parentFolderOfFiles = array();
        $getFileStatement = $this->dbCon->prepare("SELECT filename,parentfolderId FROM tab_file WHERE fileId = :fileId");
        $userId = $_SESSION['userId'];
        $getAllowedFileNamesStatement = $this->dbCon->prepare("SELECT * FROM tab_file_has_tab_user WHERE tab_user_userId = $userId");
        $getAllowedFileNamesStatement->execute();
        $fileIds = $getAllowedFileNamesStatement->fetchAll();
        foreach ($fileIds as $value) {
            $fileId = $value['tab_file_fileId'];
            $getFileStatement->bindParam(':fileId', $fileId);
            $getFileResult = $getFileStatement->execute();
            $getFileFetch = $getFileStatement->fetch($getFileResult);
            $folderName = $this->getFolderById($getFileFetch['parentfolderId']);
            if (!in_array($folderName, $allFolderNames)) {
                array_push($allFolderNames, $folderName);
                $parentFolderOfFiles[$folderName] = array();
            }
            array_push($parentFolderOfFiles[$folderName], $getFileFetch['filename']);
        }
        return [$allFolderNames, $parentFolderOfFiles];
    }

    public function getFileId($file, $folderId)
    {
        $getFileIdStatement = $this->dbCon->prepare("SELECT fileId from tab_file WHERE filename = :file AND parentfolderId = :folderId");
        $getFileIdStatement->bindParam(':file', $file);
        $getFileIdStatement->bindParam(':folderId', $folderId);
        $getFileIdResult = $getFileIdStatement->execute();
        $getFileIdFetch = $getFileIdStatement->fetch($getFileIdResult);
        return $getFileIdFetch['fileId'];
    }

    public function getFileByFileId($fileId)
    {
        $folderId = $_SESSION['folderId'];
        $getFileByFileIdStatement = $this->dbCon->prepare("SELECT filename from tab_file WHERE fileId = :fileId AND parentfolderId = :folderId");
        $getFileByFileIdStatement->bindParam(':fileId', $fileId);
        $getFileByFileIdStatement->bindParam(':folderId', $folderId);
        $getFileByFileIdResult = $getFileByFileIdStatement->execute();
        $getFileByFileIdFetch = $getFileByFileIdStatement->fetch($getFileByFileIdResult);
        return $getFileByFileIdFetch['filename'];
    }

    public function deleteFile($file)
    {
        $folderId = $_SESSION['folderId'];
        $fileId = $this->getFileId($file, $folderId);
        $deleteFileStatement = $this->dbCon->prepare("DELETE FROM tab_file WHERE fileId = $fileId");
        $this->deleteFileFromZTab($fileId);
        $deleteFileStatement->execute();
    }

    public function deleteFileFromZTab($fileId)
    {
        $deleteFileStatement = $this->dbCon->prepare("DELETE FROM tab_file_has_tab_user WHERE tab_file_fileId = $fileId");
        $deleteFileStatement->execute();
    }

    public function deleteSharePropertyFromZTab($fileId, $userName)
    {
        $userId = $this->getUserIdByUsername($userName);
        $deleteFileStatement = $this->dbCon->prepare("DELETE FROM tab_file_has_tab_user WHERE tab_file_fileId = :fileId AND tab_user_userId = :userId");
        $deleteFileStatement->bindParam(":fileId", $fileId);
        $deleteFileStatement->bindParam(":userId", $userId);
        $deleteFileStatement->execute();
    }

    public function shareFile($shareUser, $fileName)
    {

        if ($this->checkUserName($shareUser)) {
            $folderId = $_SESSION['folderId'];
            $fileId = $this->getFileId($fileName, $folderId);
            $userId = $this->getUserIdByUsername($shareUser);
            $insertShareFileStatement = $this->dbCon->prepare("INSERT INTO tab_file_has_tab_user  (tab_file_fileId, tab_user_userId) VALUES ($fileId,$userId)");
            $insertShareFileStatement->execute();
        }
    }

    public function getUserIdByUsername($userName)
    {
        $getUserIdByUsernameStatement = $this->dbCon->prepare("SELECT userId FROM tab_user WHERE userName = :userName");
        $getUserIdByUsernameStatement->bindParam(":userName", $userName);
        $getUserIdByUsernameResult = $getUserIdByUsernameStatement->execute();
        $getUserIdByUsernameFetch = $getUserIdByUsernameStatement->fetch($getUserIdByUsernameResult);
        return $getUserIdByUsernameFetch['userId'];
    }

    public function getUsernameByUserId($userId)
    {
        $getUsernameByUserIdStatement = $this->dbCon->prepare("SELECT userName FROM tab_user WHERE userId = :userId");
        $getUsernameByUserIdStatement->bindParam(":userId", $userId);
        $getUsernameByUserIdResult = $getUsernameByUserIdStatement->execute();
        $getUsernameByUserIdFetch = $getUsernameByUserIdStatement->fetch($getUsernameByUserIdResult);
        return $getUsernameByUserIdFetch['userName'];
    }
}
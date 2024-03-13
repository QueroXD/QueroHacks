<?php
    require "conn.php";

    function insertUser($username, $mail, $fName, $lName, $password) {
        $sql = "INSERT INTO users (mail, username, passHash, userFirstName, userLastName, creationDate, removeDat, lastSignIn, active)
                VALUES (:mail, :username, :passwd, :fName, :lName, NULL, NULL, NULL, 1)";

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $conn = null;
            $conn = getDBconnection();

            $db = $conn->prepare($sql);
            $db -> execute([':mail' => $mail, ':username' => $username, ':passwd' => $hashedPassword, ':fName' => $fName, ':lName' => $lName]);

        } catch (PDOException $e) {
            echo "ERROR: " . $e;
        }
    }

    function checkUser($username, $password){
        $sql = "SELECT `passHash` FROM users WHERE `username` = ? OR `mail` = ?";

        try {
            $conn = null;
            $conn = getDBconnection();

            $db = $conn->prepare($sql);
            $db -> execute([$username, $username]);

            $passHash = $db -> fetchColumn();

            $realPasswd = password_verify($password, $passHash);

            if($realPasswd == $password){
                return 1;
            }else if ($realPasswd != $password || activatedUser($username, $passHash)==1){
                return 0;
            }

        } catch (PDOException $e) {
            echo "ERROR: " . $e;
        }
    }

    function activatedUser($username, $passHash){
        $sql = "SELECT `active` FROM users WHERE `username` = ? OR `mail` = ? AND `passHash` = ?";

        try {
            $conn = null;
            $conn = getDBconnection();

            $db = $conn->prepare($sql);
            $db -> execute([$username, $username, $passHash]);

            $statusActive = $db -> fetchColumn();

            if($statusActive == 1){
                return 1;
            }else if ($statusActive == 0){
                return 0;
            }

        } catch (PDOException $e) {
            echo "ERROR: " . $e;
        }
    }

    function loginSucces($username){
        $sql = "UPDATE users SET lastSignIn = :currentDate WHERE username = :username OR mail = :mail";

        $currentDate = date("j-m-y H:i:s");

        try {
            $conn = null;
            $conn = getDBconnection();

            $db = $conn->prepare($sql);
            $db -> execute([':currentDate' => $currentDate, ':username' => $username, ':mail' => $username]);
        } catch (PDOException $e) {
            echo "ERROR: " . $e;
        }
    }
?>

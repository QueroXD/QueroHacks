<?php
    require "conn.php";

    function insertUser($username, $mail, $fName, $lName, $password) {
        $sql = "INSERT INTO users (username, mail, userFirstName, userLastName, passHash, creationDate, removeDat, lastSignIn, active)
                VALUES (?, ?, ?, ?, ?, NULL, NULL, NULL, 1)";

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            
            $conn = null;
            $conn = getDBconnection();

            $db = $conn->prepare($sql);
            $db -> execute([$username, $mail, $fName, $lName, $password]);

        } catch (PDOException $e) {
            echo "ERROR: " . $e;
        }
    }
?>

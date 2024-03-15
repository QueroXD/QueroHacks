<?php
    require "conn.php";

    function insertUser($username, $mail, $fName, $lName, $password) {
        $sql = "INSERT INTO users (mail, username, passHash, userFirstName, 
                    userLastName, creationDate, removeDat, lastSignIn, active, activationDate, activationCode, resetPassExpiry, resetPassCode)
                VALUES (:mail, :username, :passwd, :fName, 
                    :lName, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL)";

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

    function checkUser($username, $password, $option){
        $sqlPasswd = "SELECT `passHash` FROM users WHERE `username` = ? OR `mail` = ?";
        $sqlUser = "SELECT COUNT(*) FROM users WHERE `username` = ? OR `mail` = ?";

        $mail = $_POST['mail'];

        try {
            $conn = null;
            $conn = getDBconnection();

            //! Seleccionar la contraseña Hasheada
            $db = $conn->prepare($sqlPasswd);
            $db -> execute([$username, $username]);

            //! Guardar la contraseña Hasheada
            $passHash = $db -> fetchColumn();

            //? Seleccionar todos los usuarios
            $db = $conn->prepare($sqlUser);
            $db -> execute([$username, $mail]);

            //? Guardar la coincidencia
            $userDB = $db -> fetchColumn();

            //! Desencriptar la contraseña almacenada
            $realPasswd = password_verify($password, $passHash);

            if($option == 1){
                //TODO Register Mode
                if($userDB == 1){
                    return 1; // El usuario existe y no se puede crear
                }else if($userDB == 0){
                    return 0; // El usuario no existe en la BD previeamente
                }
            }else if ($opton == 2){
                //TODO Login Mode
                if($realPasswd == $password && activatedUser($username, $passHash)==1){
                    return 1; // La contraseña coincide con exito y el usuario esta activado
                }else if ($realPasswd != $password || activatedUser($username, $passHash)==0){
                    return 0; // La contraseña no coincide o el usuario no esta activado
                }
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
                return 1; // El usuario esta activado
            }else if ($statusActive == 0){
                return 0; // El usuario no esta activado
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

<?php
    require "conn.php";

    function insertUser($username, $password) {
        $conn = getDBconnection();
        
        // Verifica la conexión
        if ($conn->connect_error) {
            echo "Error de conexión: " . $conn->connect_error;
            return false; // Finaliza la función si hay un error de conexión
        }

        // Prepara la consulta para insertar un nuevo usuario
        $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";

        // Prepara la sentencia
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo "Error al preparar la consulta: " . $conn->error;
            return false; // Finaliza la función si hay un error al preparar la consulta
        }

        // Encripta la contraseña (se recomienda utilizar funciones de hash seguras)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Vincula los parámetros
        $stmt->bind_param("ss", $username, $hashed_password);

        // Ejecuta la sentencia
        if (!$stmt->execute()) {
            echo "Error al ejecutar la consulta: " . $stmt->error;
            $stmt->close();
            $conn->close();
            return false; // Finaliza la función si hay un error al ejecutar la consulta
        }

        // Cierra la conexión y la sentencia preparada
        $stmt->close();
        $conn->close();

        // Retorna true si se insertó el usuario correctamente
        return true;
    }

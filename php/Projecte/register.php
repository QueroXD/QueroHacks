<?php
require_once('login.php'); // Incluye el archivo de conexión a la base de datos

try {
    // Configuración de PDO para lanzar excepciones en caso de errores
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['mail'];
        $password = $_POST['passHash'];

        // Verificar si el nombre de usuario o correo electrónico ya existen en la base de datos
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username OR mail = :mail");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':mail', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "El nom d'usuari o email ja exsiteix";
        } else {
            // Insertar el nuevo usuario en la base de datos
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash de la contraseña
            $creationDate = date('Y-m-d H:i:s'); // Obtener la fecha y hora actual
            $active = 1; // Usuario activo

            $stmt = $db->prepare("INSERT INTO users (username, mail, passHash, creationDate, active) VALUES (:username, :mmail, :passHash, :creationDate, :active)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':mmail', $email);
            $stmt->bindParam(':passHash', $hashed_password);
            $stmt->bindParam(':creationDate', $creationDate);
            $stmt->bindParam(':active', $active);
            $stmt->execute();

            echo "Usuari creat correctament";

            header('Location: index.php');
            exit();
        }
    }
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Cerrar la conexión
$db = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de usuario</title>
</head>
<body>
    <h2>Registro de usuario</h2>
    <form method="post">
        <label for="username">Nombre de usuario:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="email">Correo electrónico:</label>
        <input type="email" name="mail" id="mail" required><br><br>
        <label for="password">Primer Nom (Opcional):</label>
        <input type="text" name="userFirstName" id="userFirstName"><br><br>
        <label for="password">Segon Nom (Opcional):</label>
        <input type="text" name="userLastName" id="userLastName"><br><br>
        <label for="password">Contrasenya:</label>
        <input type="password" name="passHash" id="passHash" required><br><br>
        <label for="password">Verifica la contrasenya:</label>
        <input type="password" name="passHash" id="passHash" required><br><br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>

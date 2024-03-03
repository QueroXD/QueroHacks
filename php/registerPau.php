<?php
require_once('login.php'); // Incluye el archivo de conexión a la base de datos

try {
    // Configuración de PDO para lanzar excepciones en caso de errores
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Verificar si el nombre de usuario o correo electrónico ya existen en la base de datos
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "El nombre de usuario o correo electrónico ya está en uso.";
        } else {
            // Insertar el nuevo usuario en la base de datos
            $stmt = $db->prepare("INSERT INTO usuarios (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password); // IMPORTANTE: ¡Esta no es la forma segura de almacenar contraseñas en una base de datos real!
            $stmt->execute();

            echo "¡Registro exitoso!"; // También podrías redirigir al usuario a otra página después del registro
        }
    }
} catch(PDOException $e) {
    // Manejo de excepciones
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
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="icon" type="image/x-icon" href="../img/QueroHacks_Icon.png">
</head>
<body>
    <h2>Registro de usuario</h2>
    <form action="register_process.php" method="post">
        <label for="username">Nombre de usuario:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email" required><br><br>
        <label for="password">Primer Nom (Opcional):</label>
        <input type="text" name="userFirstName" id="userFirstName"><br><br>
        <label for="password">Segon Nom (Opcional):</label>
        <input type="text" name="userLastName" id="userLastName"><br><br>
        <label for="password">Contrasenya:</label>
        <input type="password" name="password" id="password" required><br><br>
        <label for="password">Verifica la contrasenya:</label>
        <input type="password" name="password" id="password" required><br><br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>

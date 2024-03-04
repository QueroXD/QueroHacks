<?php
require "../lib/conn.php";

try {
    // Configuración de PDO para lanzar excepciones en caso de errores
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Consulta preparada para evitar inyección de SQL
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username AND passHash = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Verificar si el usuario existe en la base de datos
        if ($stmt->rowCount() == 1) {
            // Usuario autenticado correctamente
            session_start();
            echo "¡Inicio de sesión exitoso!";
            header("Location: home.php");
            // Aquí podrías redirigir al usuario a otra página
        } else {
            // Usuario o contraseña incorrectos
            echo "Nombre de usuario o contraseña incorrectos.";
        }
    }
} catch (PDOException $e) {
    // Manejo de excepciones
    echo "Error de conexión: " . $e->getMessage();
}

// Cerrar la conexión
$db = null;
?>

<!DOCTYPE html>
<html>
  <head>
    <title>QueroHacks</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="stylesheet" href="../css/common.css" />
    <link rel="stylesheet" href="../css/register.css" />
    <link rel="icon" type="image/x-icon" href="../img/QueroHacks_Icon.png" />
  </head>
  <body>
    <main>
      <div id="container-form">
        <img src="../img/QueroHacks_Logo.jpg" alt="Logo ClassWave" id="iconoEmpresa"/>
        <h1>Sign In</h1>
        <form method="post">
          <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required />
          </div>
          <div>
            <label for="password">Password:</label>
            <input type="password" id="passwd" name="passwd" required />
          </div>
          <input type="submit" value="SUBMIT" id="button" />
        </form>
        <div>
          <footer> New user? <a href="register.php">Sign Up</a></footer>
        </div>
      </div>
    </main>
  </body>
</html>

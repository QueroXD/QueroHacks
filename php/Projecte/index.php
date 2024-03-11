<?php
require_once('login.php'); // Incluye el archivo de conexión a la base de datos

try {
    // Configuración de PDO para lanzar excepciones en caso de errores
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
            $_SESSION['username'] = $username;
            header("Location: home.php");
            // Aquí podrías redirigir al usuario a otra página
        } else {
            // Usuario o contraseña incorrectos
            echo "Nombre de usuario o contraseña incorrectos.";
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
<html>
<head>
	<title>QueroHacks</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <div class="mb-md-5 mt-md-4 pb-5">
              <h2 class="fw-bold mb-2 text-uppercase">QueroHacks</h2>
              <p class="text-white-50 mb-5">Entra el teu usuari i contrasenya per entrar!!</p>
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-outline form-white mb-4">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control form-control-lg">
                </div>
                <br>
                <br>
                <div class="form-outline form-white mb-4">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control form-control-lg">
                </div>
                <br>
                <br>
                <input class="btn btn-outline-light btn-lg px-5" type="submit" value="Submit">
                <br>
                <br>
            </form>
            </div>
            <div>
              <p class="mb-0">No tens un comte? <a href="register.php" class="text-white-50 fw-bold">Sign Up</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
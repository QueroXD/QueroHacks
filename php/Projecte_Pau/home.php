<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// Obtener el nombre de usuario de la sesión
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
    <style>
        body {
            background-image: url('QueroHacks_Logo.jpeg'); /* Cambia 'background.jpg' por la ruta de tu imagen de fondo */
            background-size: cover;
            background-position: center;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            padding-top: 100px;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        .logout-button {
            padding: 10px 20px;
            background-color: #ff6666;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Benvingut, <?php echo $username; ?>!</h1>
        <!-- Puedes cambiar 'background.jpg' por la ruta de tu imagen de fondo -->
        <img src="" alt="Imatge de Fons" width="500">
        <br><br>
        <form action="logout.php" method="post">
            <input type="submit" value="Tancar Sessió" class="logout-button">
        </form>
    </div>
</body>
</html>

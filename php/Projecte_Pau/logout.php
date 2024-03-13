<?php
// Iniciar o reanudar la sesión
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Finalizar la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión (o cualquier otra página que desees después de cerrar sesión)
header("Location: index.php");
exit();
?>
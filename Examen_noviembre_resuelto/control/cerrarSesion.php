<?php
// Inicia la sesión para poder manipularla
session_start();

// Destruye  la sesión

session_destroy();

// Opcional: Redirige a la página de inicio o de login
header("Location: ../index.html"); // Cambia "index.php" por la URL deseada
exit();

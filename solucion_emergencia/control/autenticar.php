<?php
// Simulación de base de datos de usuarios y contraseñas
$usuarios = [
    "admin1" => "1234", // Usuario admin1 con contraseña 1234
    "admin2" => "2345"  // Usuario admin2 con contraseña 2345
];

// Verificar si los datos fueron enviados desde el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $usuario_ingresado = $_POST['usuario'];
    $contraseña_ingresada = $_POST['contraseña'];

    // Verificar si el usuario existe en la base de datos simulada
    if (array_key_exists($usuario_ingresado, $usuarios)) {
        // Verificar si la contraseña es correcta
        if ($usuarios[$usuario_ingresado] === $contraseña_ingresada) {
            header("Location: control/consultaEstadoEmergencia.php");
            exit();
        } else {
            header("Location:'index.html");
            exit();
        }
    } else {
        echo "Usuario no encontrado.";
        
    }
} 


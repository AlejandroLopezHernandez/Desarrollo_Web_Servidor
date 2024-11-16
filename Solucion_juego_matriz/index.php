<?php
require_once 'VistaTablero.php';
session_start();
$vista = new VistaTablero();
// Inicializar o reiniciar el juego
// Leer configuración de trampas y salida al iniciar , y meterlas en la sesión si no están
if (!isset($_SESSION['traps']) || !isset($_SESSION['exit'])) {
    $config = json_decode(file_get_contents("config.json"), true);
    $_SESSION['traps'] = $config['traps'];
    $_SESSION['exit'] = $config['exit'];
    $_SESSION['position']=$config['init'];
    $_SESSION['exit']=$config['exit'];
    $_SESSION['score'] = 100;
    $_SESSION['moves'] = [];
}

// Mostrar tablero
$vista->mostrarTablero($_SESSION['position'],$_SESSION['exit'],$_SESSION['score']);


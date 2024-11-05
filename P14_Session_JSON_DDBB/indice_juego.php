<?php
require_once 'vista_tablero.php';
require_once 'verPartidasGuardadas.php';
session_start();
$vista = new VistaTablero();

// Inicializar o reiniciar el juego
// Leer configuración de trampas y salida al iniciar y meterlas en lasesión si no están
if (!isset($_SESSION['traps']) || !isset($_SESSION['exit'])) {
    $config = json_decode(file_get_contents("trampas_config.json"), true);
    $_SESSION['traps'] = $config['traps'];
    $_SESSION['exit'] = $config['exit'];
    $_SESSION['position'] = $config['init'];
    $_SESSION['score'] = 100;
    $_SESSION['moves'] = [];
}
//Creamos el objeto vista y le damos los parámetros
$vista->mostrarTablero($_SESSION['position'], $_SESSION['exit'], $_SESSION['score']);


<?php
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';

session_start();

if (!isset($_SESSION['usuario_admin'])) {
    header('Location: autenticar.php');
    exit;
}
// Configuración de base de datos
$repositorio = new RepositoryMysql('mysql', 'FLOTA', 'root', '1234');
$vista = new VistaHTML();



// Procesar datos enviados por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener localidad desde el formulario
    $localidad=$_POST['localidad'];
    //$localidad = filter_input(INPUT_POST, 'localidad', FILTER_SANITIZE_STRING);

    if ($localidad) {
        // Llamar al método para incrementar los tiempos de espera
        $filasAfectadas = $repositorio->incrementarTiemposEspera($localidad);

        echo "<h1>Resultado</h1>";
        if ($filasAfectadas > 0) {
            echo "<p>Se han incrementado los tiempos de espera en un 20% para <strong>" . htmlspecialchars($localidad) . "</strong>.</p>";
        } else {
            echo "<p>No se encontraron entregas en la localidad <strong>" . htmlspecialchars($localidad) . "</strong>.</p>";
        }
    } else {
        echo "<p>Por favor, introduce una localidad válida.</p>";
    }
} else {
    echo "<p>El formulario no ha sido enviado correctamente.</p>";
}



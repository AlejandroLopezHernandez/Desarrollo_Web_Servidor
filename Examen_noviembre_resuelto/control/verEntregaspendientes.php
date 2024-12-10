<?php
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';

// Configuración de base de datos
$repositorio = new RepositoryMysql('mysql', 'FLOTA', 'root', '1234');
$vista = new VistaHTML();

// Recuperar filtros desde el formulario o cookies
$conductor = isset($_GET['conductor']) ? $_GET['conductor'] : (isset($_COOKIE['conductor']) ? $_COOKIE['conductor'] : null);
$vehiculo = isset($_GET['vehiculo']) ? $_GET['vehiculo'] : (isset($_COOKIE['vehiculo']) ? $_COOKIE['vehiculo'] : null);

// Guardar filtros en cookies
if ($conductor) {
    setcookie('conductor', $conductor, time() + 3600); // Expira en 1 hora
}

if ($vehiculo) {
    setcookie('vehiculo', $vehiculo, time() + 3600);
}

// Obtener entregas pendientes según los filtros , si el fitro de conductores no es vacio siempre se consulta por este
// y se ignora el otro
$entregas="";
if (!empty($conductor)) {
    $entregas = $repositorio->getEntregasPendientesConductor($conductor);
} elseif (!empty($vehiculo)) {
    $entregas = $repositorio->getEntregasPendientesVehiculo($vehiculo);
} 

// Mostrar resultados
$vista->mostrarEntregasPendientes($entregas);
?>

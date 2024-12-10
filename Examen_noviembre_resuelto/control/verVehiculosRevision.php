<?php
// Configuración de conexión con la base de datos
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';
$host = 'mysql';
$dbname = 'FLOTA';
$username = 'root';
$password = '1234';

$repository = new RepositoryMySQL($host, $dbname, $username, $password);
$vista =  new VistaHTML();

session_start();
// Si no ha iniciado sesión como administrador redirgir a autenticar.php
if (!isset($_SESSION['usuario_admin'])) {
    header('Location: autenticar.php');
    exit;
} else {

    // Si continua por aquí es que el primer if es falso y  ha iniciado sesión
    $vehiculos = $repository->getvehiculosRevision();

    $vista->mostrarVehiculosRevision($vehiculos);
}

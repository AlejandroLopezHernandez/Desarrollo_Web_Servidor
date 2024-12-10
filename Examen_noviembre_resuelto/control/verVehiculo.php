<?php
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';

// Configuración de base de datos
$repositorio = new RepositoryMysql('mysql', 'FLOTA', 'root', '1234');
$vista = new VistaHTML();


if (isset($_GET['matricula'])) {

    $vehiculo = $repositorio->getVehiculo($_GET['matricula']);

    $vista->mostrarVehiculo($vehiculo);
}

<?php
// Incluir la clase RepositoryMySQL
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';

// Configuración de conexión con la base de datos
$host = 'mysql';
$dbname = 'FLOTA';
$username = 'root';
$password = '1234';

// Crear una instancia del repositorio
$repository = new RepositoryMySQL($host, $dbname, $username, $password);

// Obtener las coordenadas de los vehículos
$vehiculos = $repository->obtenerCoordenadasVehiculos();

// Crear una instancia de la clase VistaHTML
$vista = new VistaHTML();

// Generar y mostrar la cuadrícula
$vista->generarCuadricula2($vehiculos);


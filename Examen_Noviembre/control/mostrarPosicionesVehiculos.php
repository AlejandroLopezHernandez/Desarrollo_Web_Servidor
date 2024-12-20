<?php
require_once '../clases/VistaHTML.php';
require_once '../clases/RepositoryMySQL.php';

echo "<h2>Mostrar matriz</h2>";

$vista_matriz = new VistaHTMLFlota();
$repositorio = new RepositorioSQLFlotaVehiculos('mysql','FLOTA','root','1234');

$datos_vehiculos_y_coordenadas = $repositorio->VehiculosEnRuta();
$vista_matriz->ImprimirMatriz($datos_vehiculos_y_coordenadas);
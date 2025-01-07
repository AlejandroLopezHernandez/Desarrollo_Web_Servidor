<?php
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';

$repositorio = new RepositorioSQLFlota('mysql','FLOTA','root','1234');
$vista = new VistaFlota();

$vehiculos_en_ruta = $repositorio->vehiculos_en_ruta();
$vista->imprimir_matriz($vehiculos_en_ruta);
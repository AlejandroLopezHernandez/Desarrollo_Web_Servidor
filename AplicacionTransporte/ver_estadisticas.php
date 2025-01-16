<?php
require_once 'repositorioSQL.php';
require_once 'Vista.php';

$vista = new Vista_Transporte();

$servidor = 'mysql';
$bbdd = 'Transporte';
$usuario = 'root';
$contraseña = '1234';
$repositorio = new Repostorio_MySQL_Transporte($servidor,$bbdd,$usuario,$contraseña);

$numero_barcos = $repositorio->obtener_n_barcos();
$numero_aviones = $repositorio->obtener_n_aviones();
$numero_vehiculos = $repositorio->obtener_n_vehiculos();

$vista->n_aviones($numero_aviones);
$vista->n_barcos($numero_barcos);
$vista->n_vehiculos($numero_vehiculos);
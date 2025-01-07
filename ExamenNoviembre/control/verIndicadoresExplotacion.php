<?php
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';

$repositorio = new RepositorioSQLFlota('mysql','FLOTA','root','1234');
$vista = new VistaFlota();

$vehiculos_disponibles = $repositorio->vehiculos_disponibles();
$vista->VehiculosDisponibles($vehiculos_disponibles);
$vehiculos_no_disponibles =$repositorio->vehiculos_no_disponibles();
$vista->VehiculosNoDisponibles($vehiculos_no_disponibles);
$vehiculos_pendientes = $repositorio->vehiculos_pendientes();
$vista->VehiculosPendientes($vehiculos_pendientes);
$tiempo_real = $repositorio->promedio_tiempo_real();
$vista->TiempoReal($tiempo_real);
$tiempo_maximo = $repositorio->promedio_tiempo_maximo();
$vista->TiempoMaximo($tiempo_maximo);
$datos_mantenimiento = $repositorio->datos_mantenimiento();
$vista->DatosMantenimiento($datos_mantenimiento);
$ciudad_mas_entregas = $repositorio->ciudad_max_entregas();
$vista->CiudadMasEntregas($ciudad_mas_entregas);
$coste_conductores = $repositorio->coste_conductores();
$vista->CosteConductores($coste_conductores);

<?php
require_once '../clases/VistaHTML.php';
require_once '../clases/RepositoryMySQL.php';

$vista = new VistaHTMLFlota();
$repositorio = new RepositorioSQLFlotaVehiculos('mysql','FLOTA','root','1234');

$vehiculos_disponibles = $repositorio->VehiculosDisponibles();
$vehiculos_no_disponibles = $repositorio->VehiculosNoDisponibles();
$vista->MostrarVehiculosDisponibles($vehiculos_disponibles);
$vista->MostrarVehiculosNoDisponibles($vehiculos_no_disponibles);

$entregas_pendientes = $repositorio->EntregasPendientes();
$vista->MostrarEntregasPendientes($entregas_pendientes);

$tiempos_entrega_real = $repositorio->TiemposEntregaReal();
$vista->MostrarTiemposEntregaReal($tiempos_entrega_real);

$tiempos_entrega_maximo = $repositorio->TiemposEntregaMaximo();
$vista->MostrarTiemposEntregaMaximo($tiempos_entrega_maximo);

$entregas_a_tiempo = $repositorio->EntregasATiempo();
$vista->MostrarEntregasATiempo($entregas_a_tiempo);

$km_para_maneminiento = $repositorio->KMsEstimadosParaMantinimiento();
$vista->MostrarKMsParaMantenimiento($km_para_maneminiento);

$ciudad_max_entregas = $repositorio->CiudadConMasEntregas();
$vista->MostrarCiudadMaxEntregas($ciudad_max_entregas);

$costeXconductor = $repositorio->CosteXConductor();
$vista->MostrarCosteXConductor($costeXconductor);


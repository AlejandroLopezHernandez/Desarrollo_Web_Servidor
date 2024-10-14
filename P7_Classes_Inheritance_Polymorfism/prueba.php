<?php
// 1.-Instancia el SistemaCentral 
include 'Sistema_Central.php';
include 'Dron.php';
include 'Coche.php';
include 'Central_recarga.php';
//include 'VehiculoAutonomo.php';
// 2.- crea un Dron en coordenadas [10,20] y un Coche con coordenadas [30,40]
$coche1 = new Coche(1, [30, 40], 100);
$dron1 = new Dron(2, [10, 20], 100);
$sistema_central = new SistemaCentral();
//3.-Agrega los vehículos en el Sistema central 
$sistema_central->agregarVehiculo($coche1, 1);
$sistema_central->agregarVehiculo($dron1, 2);
//Agrega una central de recarga en [15,25] y [35,45] 

$central_recarga1 = new CentralRecarga(3, [15, 25], true);
$central_recarga2 = new CentralRecarga(4, [35, 45], true);

$sistema_central->agregarCentralRecarga($central_recarga1, 3); //agregación
$sistema_central->agregarCentralRecarga($central_recarga2, 4);
// Muestra los vehículos que tiene el sistema 
$sistema_central->mostrarVehiculos();
// Recarga el dron 
$coche1->recargarBateria();
// Recarga el coche 
$dron1->recargarBateria();
$sistema_central->mostrarCentrales();
print_r($sistema_central->encontrarCentralCercana($coche1->getCoordenadas()));

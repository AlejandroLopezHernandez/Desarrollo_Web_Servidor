<?php
// 1.-Instancia el SistemaCentral 
include 'Sistema_Central.php';
//El orden sí importa, como coche y dron heredan propiedades de vehículo autónomo, hay que declarar primero la clase de vehículo autónomo
include 'Vehiculo_Autonomo.php';
include 'Dron.php';
include 'Coche.php';
include 'Central_recarga.php';
// 2.- crea un Dron en coordenadas [10,20] y un Coche con coordenadas [30,40]
$coche1 = new Coche(1, [30, 40], 100);
$dron1 = new Dron(2, [10, 20], 100);
//3.-Agrega los vehículos en el Sistema central 
$sistema_central = new SistemaCentral();
$sistema_central->agregarVehiculo($coche1);
$sistema_central->agregarVehiculo($dron1);
//Agrega una central de recarga en [15,25] y [35,45] 

$central_recarga1 = new CentralRecarga(3, [15, 25], true);
$central_recarga2 = new CentralRecarga(4, [35, 45], true);

$sistema_central->agregarCentralRecarga($central_recarga1);
$sistema_central->agregarCentralRecarga($central_recarga2);
// Muestra los vehículos que tiene el sistema 
$sistema->mostrarVehiculos();
// Recarga el dron 
$dron1->recargarBateria();
// Recarga el coche 
$coche1->recargarBateria();
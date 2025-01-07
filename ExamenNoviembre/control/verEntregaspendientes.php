<?php
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';

$repositorio = new RepositorioSQLFlota('mysql','FLOTA','root','1234');
$vista = new VistaFlota();

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == 1){
    $datos = $repositorio->buscar_conductor_x_id($_POST['conductor_id']);
    $vista->mostrar_conductor($datos);
} else if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == 2){
    $datos = $repositorio->buscar_vehiculo_x_id($_POST['vehiculo_id']);
    $vista->mostrar_vehiculo($datos);
}
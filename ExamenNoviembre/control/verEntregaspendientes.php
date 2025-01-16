<?php
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';

$repositorio = new RepositorioSQLFlota('mysql','FLOTA','root','1234');
$vista = new VistaFlota();

$conductor;
if (isset($_GET['conductor'])){
$conductor = $_GET['conductor'];
} else if (isset($_COOKIE['conductor'])){
    $conductor = $_COOKIE['conductor'];
} else {
    $conductor = null;
}
$vehiculo;
if (isset($_GET['vehiculo'])){
    $vehiculo = $_GET['vehiculo'];
    } else if (isset($_COOKIE['vehiculo'])){
        $vehiculo = $_COOKIE['vehiculo'];
    } else {
        $conductor = null;
    }
if($conductor){
setcookie('conductor',$conductor,time()+3600);
}
if($vehiculo){
    setcookie('vehiculo',$vehiculo,time()+3600);
}
$datos = "";
if(!empty($conductor)){
    $datos = $repositorio->buscar_conductor_x_id($conductor);
    $vista->mostrar_conductor($datos);
} elseif(!empty($vehiculo)){
    $datos = $repositorio->buscar_vehiculo_x_id($vehiculo);
    $vista->mostrar_vehiculo($datos);
}


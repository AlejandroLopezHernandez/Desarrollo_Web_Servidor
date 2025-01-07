<?php
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';

session_start();
if(!isset($_SESSION['usuario_administrador'])){
    header('Location: autenticar.php');
    exit;
}
$repositorio = new RepositorioSQLFlota('mysql','FLOTA','root','1234');
$vista = new VistaFlota();

$vehiculos_en_revision = $repositorio->vehiculos_revision();
$vista->vehiculos_en_revision($vehiculos_en_revision);

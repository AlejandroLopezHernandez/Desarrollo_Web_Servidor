<?php
session_start();
if(!isset($_SESSION['usuario_administrador'])){
    header('Location: ./autentificacion.php');
}
require_once 'repositorioSQL.php';

$servidor = 'mysql';
$bbdd = 'Transporte';
$usuario = 'root';
$contraseña = '1234';
$repositorio = new Repostorio_MySQL_Transporte($servidor,$bbdd,$usuario,$contraseña);

$repositorio->rebajar_precio_mantenimiento($_POST['id_vehiculo']);
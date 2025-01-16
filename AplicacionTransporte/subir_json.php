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

$ruta_de_destino = "./subidas/";
$destino_del_archivo = $ruta_de_destino.basename($_FILES['archivo_subido']['name']);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!is_dir($ruta_de_destino)){
        mkdir($ruta_de_destino,0777,true);
    }
    if(move_uploaded_file($_FILES['archivo_subido']['tmp_name'],$destino_del_archivo)){
        echo "Archivo JSON subido con éxito";
    } else {
        echo "Error al subir el archivo";
    }
}
$ruta_json = './subidas/nuevos_barcos_aviones.json';
$datos_json = file_get_contents($ruta_json);
$datos_json_decodificados = json_decode($datos_json,true);

$aviones = $datos_json_decodificados['aviones'];
$barcos = $datos_json_decodificados['barcos'];

foreach($aviones as $avion){
$id = $avion['id'];
$altura_maxima = $avion['altura_maxima'];
$velocidad_maxima = $avion['velocidad_maxima'];
$tipo_alas = $avion['tipo_alas'];
$autonomia = $avion['autonomia'];

//$repositorio->insertar_avion($id,$altura_maxima,$velocidad_maxima,$tipo_alas,$autonomia);
}
foreach($barcos as $barco){
$id = $barco['id'];
$longitud = $barco['longitud'];
$tipo_propulsion = $barco['tipo_propulsion'];
$calado_maximo = $barco['calado_maximo'];

$repositorio->insertar_barco($id,$longitud,$tipo_propulsion,$calado_maximo);
}

/*$vehiculos = $datos_json_decodificados['vehiculos'];
foreach($vehiculos as $vehiculo){
    $id = $vehiculo['id'];
    $nombre = $vehiculo['nombre'];
    $codigo_modelo = $vehiculo['codigo_modelo'];
    $capcidad_carga = $vehiculo['capacidad_carga'];
    $activo = $vehiculo['activo'];

    $repositorio->insertar_vehiculo($id,$nombre,$codigo_modelo,$capcidad_carga,$activo);
}*/


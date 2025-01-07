<?php
session_start();
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';

$repositorio = new RepositorioSQLFlota('mysql','FLOTA','root','1234');
$vista = new VistaFlota();
//En estaa ruta se van a subir los archivos subidos
$ruta_de_destino = "./subidas/";
//Esta es la ruta completa del archivo subido, junto con su nombre
$destino_del_archivo = $ruta_de_destino.basename($_FILES['archivo_subido']['name']);
//Si el método de petición es POST, se sube el archivo
if($_SERVER['REQUEST_METHOD'] =='POST'){
    //Si no existe la carpeta, se crea
    if(!is_dir($ruta_de_destino)){
        mkdir($ruta_de_destino,0777,true);
    }
    //Movemos el archivo de su ubicación temporal a la carpeta de destino
    if(move_uploaded_file($_FILES['archivo_subido']['tmp_name'],$destino_del_archivo)){
        echo "El archivo se ha subido con éxito.<br>";
    } else{
        echo "Error al subir el archivo.<br>";
    }
}
//Definimos la ruta del archivo JSON que vamos a leer
$ruta_json = './subidas/nuevaFlota.json';
//Leemos el archivo JSON
$datos_json = file_get_contents($ruta_json);
//Decodificamos el archivo JSON
$datos_json_decodificados = json_decode($datos_json,true);
$vehiculos = $datos_json_decodificados['vehiculos'];
$conductores = $datos_json_decodificados['conductores'];

$contador_vehiculos = 0;
$contador_conductores = 0;

foreach($vehiculos as $vehiculo){
//Los nombres entre corchetes deben ser los mismos que en el JSON
$id_vehiculo = $vehiculo['id'];
$tipo = $vehiculo['tipo'];
$matricula = $vehiculo['matricula'];
$alarma = $vehiculo['alarma_revision'];
$coordenadax = $vehiculo['coordenada_x'];
$coordenaday = $vehiculo['coordenada_y'];
$contador_vehiculos ++;

$repositorio->insertar_vehiculo($id_vehiculo,$matricula,$tipo,$alarma,$coordenadax,$coordenaday);
}
foreach($conductores as $conductor){
$id_conductor = $conductor['id'];
$nombre = $conductor['nombre'];
$telefono = $conductor['telefono'];
$contador_conductores ++;

$repositorio->insertar_conductor($id_conductor,$nombre,$telefono);
}

$id_admin = $_SESSION['usuario_administrador'];
$fecha = date('Y-m-d');

$repositorio->insertar_log($id_admin,$fecha,$contador_vehiculos,$contador_conductores);
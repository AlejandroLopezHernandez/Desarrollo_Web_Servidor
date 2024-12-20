<?php
require_once '../clases/RepositoryMySQL.php';

session_start();
if(!isset($_SESSION['usuario_admin'])){
    header('Location: autenticar.php');
    exit;
}
$ruta_destino = "./subidas/";
$destino_archivo = $ruta_destino .basename($_FILES["archivo_subido"]["name"]);
$subida_correcta = 1;
//Si el método es POST, se sube
if($_SERVER['REQUEST_METHOD']=="POST"){
    //Vemos si existe el directorio dónde vamos a subir el JSON
    //Si no existe, lo creamos mediante comando
    if(!is_dir($ruta_destino)){
        mkdir($ruta_destino,0777,true);
    }
    if($subida_correcta == 0){
        echo "Error al subir el archivo. Tipo error 1";
    } else {
        //Movemos el archivo subido a la ruta de destino
        if(move_uploaded_file($_FILES["archivo_subido"]["tmp_name"],$destino_archivo)){
            echo "Archivo subido con éxito";
        } else {
            echo "Error al subir el archivo. Tipo error 2";
        }
    }
} else {
    echo "Método de solicitud no válido. Sólo con POST";
}
$repositorio = new RepositorioSQLFlotaVehiculos('mysql','FLOTA','root','1234');
$ruta_archivo_subido = $destino_archivo;
$datos_json = file_get_contents($ruta_archivo_subido);
$json_decodificado = json_decode($datos_json,true);
$array_archivos = $json_decodificado;
$vehiculos = $array_archivos['vehiculos'];
$conductores = $array_archivos['conductores'];

foreach($vehiculos as $vehiculo){
    $id_vehiculo = $vehiculo['id_vehiculo'];
    $tipo = $vehiculo['tipo'];
    $matricula = $vehiculo['matricula'];
    $alarma_revision = $vehiculo['alarma_revision'];
    $coordenada_x = $vehiculo['coordenada_x'];
    $coordenada_y = $vehiculo['coordenada_y'];
    $insercionVehiculo = $repositorio->InsertarDatosFlotaVehiculos($id_vehiculo,$tipo,$matricula,$alarma_revision,$coordenada_x,$coordenada_y);
}
    foreach($conductores as $conductor){
        $id_conductor = $conductor['id_conductor'];
        $nombre = $conductor['nombre'];
        $telefono = $conductor['telefono'];
        
        $insercionConductor = $repositorio->InsertarDatosFlotaConductores($id_conductor,$nombre,$telefono);
    }




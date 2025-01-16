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

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $ruta_de_destino = "./subidas/";
    if(!is_dir($ruta_de_destino)){
        mkdir($ruta_de_destino,0777,true);
    }
    $destino_del_archivo = $ruta_de_destino.basename($_FILES['archivo_subido']['name']);
    if(move_uploaded_file($_FILES['archivo_subido']['tmp_name'],$destino_del_archivo)){
        echo "Archivo subido con éxito";
    } else {
        echo "Error al subir el archivo";
    }
    $puntero = fopen($destino_del_archivo,'r');
    $cabecera = fgetcsv($puntero);

    while($datos = fgetcsv($puntero)){

        $fila_asociativa = array_combine($cabecera,$datos);
        $id = $fila_asociativa['id'];
        /*$nombre = $fila_asociativa['nombre'];
        $codigo_modelo = $fila_asociativa['codigo_modelo'];
        $capacidad_carga = $fila_asociativa['capacidad_carga'];
        $activo = $fila_asociativa['activo'];*/

        /*$longitud = $fila_asociativa['longitud'];
        $tipo_propulsion = $fila_asociativa['tipo_propulsion'];
        $calado_maximo = $fila_asociativa['calado_maximo'];*/
        
        $altura_maxima = $fila_asociativa['altura_maxima'];
        $velocidad_maxima = $fila_asociativa['velocidad_maxima'];
        $alas = $fila_asociativa['tipo_alas'];
        $autonomia = $fila_asociativa['autonomia'];

        $repositorio->insertar_avion($id,$altura_maxima,$velocidad_maxima,$alas,$autonomia);

        //$repositorio->insertar_vehiculo($id,$nombre,$codigo_modelo,$capacidad_carga,$activo);
        //$repositorio->insertar_barco($id,$longitud,$tipo_propulsion,$calado_maximo);

    }
    fclose($puntero);
}
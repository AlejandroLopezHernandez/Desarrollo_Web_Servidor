<?php
require_once '../clases/RepositoryMySQL.php';

$repositorio = new RepositorioSQLFlota('mysql','FLOTA','root','1234');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $ruta_de_destino = "./subidas/";
    if(!is_dir($ruta_de_destino)){
        mkdir($ruta_de_destino,0777,true);
    }
    $destino_del_archivo = $ruta_de_destino.basename($_FILES['archivo_subido']['name']);
    if(move_uploaded_file($_FILES['archivo_subido']['tmp_name'],$destino_del_archivo)){
        echo "Archivo subido con éxito <br>";
    } else {
        echo "Error al subir el archivo";
    }
    $puntero = fopen($destino_del_archivo,'r');
    $cabecera = fgetcsv($puntero);

    while($datos = fgetcsv($puntero)){
        $fila_asociativa = array_combine($cabecera,$datos);
        $id = $fila_asociativa['id_conductor'];
        $nombre = $fila_asociativa['nombre'];
        $telefono = $fila_asociativa['telefono'];

        $repositorio->insertar_datos_conductor_csv($id,$nombre,$telefono);
    }

    fclose($puntero);
}
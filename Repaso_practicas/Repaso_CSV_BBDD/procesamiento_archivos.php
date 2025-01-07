<?php
require_once 'repositorio.php';
require_once 'vista.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $ruta_destino = "./uploads";
    if(!is_dir($ruta_destino)){
        mkdir($ruta_destino,0777,true);
    }
    $destino_archivo = $ruta_destino.basename($_FILES['archivo_csv']['name']);
    //$ruta_temporal = $_FILES['archivo_csv']['tmp_name'];

    if(move_uploaded_file($_FILES['archivo_csv']['tmp_name'],
    $destino_archivo)){
        echo "Archivo subido con éxito";
    } 
    $puntero = fopen($destino_archivo,'r');
    $cabecera = fgetcsv($puntero);

    
    while($datos = fgetcsv($puntero)){
        $fila_asociativa = array_combine($cabecera,$datos);
        $año = $fila_asociativa['Any'];
        $codigo_pais = $fila_asociativa['Codi País'];
        $nacionalidad = $fila_asociativa['Nacionalitat'];
        $poblacion = $fila_asociativa['Poblacio'];


        $repositorio = new Repositorio_inmigracion('mysql','inmigracion','root','1234');
        $repositorio->InsertarDatos($año,$codigo_pais,$nacionalidad,$poblacion);
    }

    
fclose($puntero);

} else if(isset($_GET['action']) && $_GET['action'] == 2) {
    $repositorio = new Repositorio_inmigracion('mysql','inmigracion','root','1234');
    $datos_inmigracion = $repositorio->MostrarDatos();
    $vista = new Vista_inmigracion();
    $vista->MostrarDatos($datos_inmigracion);
}else{
    echo "Error al subir archivo CSV";
}
<?php
require_once '../Clases/repositorio_mysql.php';
/*1.- Abrir el archivo CSV y leer el nombre del municipio (primer campo).*/
//Primero vemos si existe dicho archivo
if (isset($_FILES['archivo_csv'])) {
    //Aquí es dónde vamos a mover el archivo
    $ruta_destino = "../Control/uploads/";
    //Esta es la ruta temporal, dónde va a estar cuando lo suba el usuario
    $ruta_temporal = $_FILES['archivo_csv']['tmp_name'];
    /*Está en la ruta temporal porque comprueba si ya existe una carpeta,
    si está en la carpta hay que poner la ruta completa, no sólo el nombre*/
    $puntero_csv = fopen($ruta_temporal, 'r');
    //Primero abres la cabecera
    $datos = fgetcsv($puntero_csv);
    //Y lo leemos otra vez para leer los datos del archivo
    $datos = fgetcsv($puntero_csv);
    //Leemos el archivo, como si fuera un array, usamos corchetes y la posicion [0]
    $municipio = $datos[0];
    $personas_afectadas = $datos[1];
    $comunicaciones_cortadas = $datos[2];
    $necesidades_ayuda = $datos[3];

    //2.- Crear carpeta del municipio si no existe, NOTA: El nombre del municipio se debe poner 
    $folderPath = "uploads/" . $municipio;
    //2.1 Si no existe creamos la carpeta 
    if (!file_exists($folderPath)) {
        mkdir($folderPath, 0777, true);
    }
    // Ruta final del archivo en la carpeta del municipio 
    $ruta_final = $folderPath . "/ultimo_reporte.csv";
    //3. Mover el archivo a la carpeta del municipio, sobrescribiendo el archivo anterior 
    if (move_uploaded_file($ruta_temporal, $ruta_final)) {
        echo "Archivo CSV subido correctamente a la carpeta de municipio";
    }
    //4.- Verificar la última fecha de actualización en la base de datos 
    $repositorio = new RepositorioMYSQL('mysql', 'emergencia', 'root', '1234');
    $lastUpdate = $repositorio->obtenerUltimaFechaReporte($municipio);
    $newUpdate = filemtime($ruta_final); // Fecha de subida del archivo 
    /*5.- Buscar palabras clave en el campo necesidades de ayuda con la función strpos 
    NOTA: ESTO SE DEBE HACER POR CADA NECESIDAD ESTABLECIDA*/
    $agua = 0;
    $productos_limpieza = 0;
    $viveres = 0;
    $medicinas = 0;

    if (stripos($necesidades_ayuda, 'agua') !== false) {
        $agua = 1;
    }
    if(stripos($necesidades_ayuda,'productos_limpieza')!== false){
        $productos_limpieza = 1;
    }
    if(stripos($necesidades_ayuda,'víveres')!== false){
        $viveres = 1;
    }
    if(stripos($necesidades_ayuda,'medicinas')!== false){
        $medicinas = 1;
    }
    // Asignar a $otros si no se encuentra ninguna palabra clave
    $otros = 0;
    if($agua === 0 && $productos_limpieza === 0 && $viveres === 0 && $medicinas === 0){
        $otros = $necesidades_ayuda;
    }
    //5.- Insertar o actualizar los datos en la base de datos

    $repositorio->guardarEstadoMunicipio(
        $municipio,
        $personas_afectadas,
        $comunicaciones_cortadas,
        $agua,
        $productos_limpieza,
        $viveres,
        $medicinas,
        $otros
    );
    //6.- Cerrar el archivo
    fclose($puntero_csv);
}

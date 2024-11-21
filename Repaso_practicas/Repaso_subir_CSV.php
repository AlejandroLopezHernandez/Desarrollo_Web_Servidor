<?php
/** Variables para trabajar con el archivo subido y su ruta*/ 
$destino_ruta = "./dataset/"; // directorio donde se subirán los archivos 
$destino_archivo = $destino_ruta . basename($_FILES["archivo"]["name"]); // ruta completa, en el HTML
$archivoTipoArchivo = strtolower(pathinfo($destino_archivo, PATHINFO_EXTENSION)); // obtenemos la extensión
$uploadOk = 1; // flag  
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if (file_exists($destino_archivo)) { // si el archivo existe, habrá un error, activar flag 
        $uploadOk = 0; 
    } 
    //Cuidado con esta línea de código
    if ($archivoTipoArchivo != 'csv') { // si el archivo no es csv o json activar flag 
        $uploadOk = 0; 
    } 
    if ($uploadOk == 0) { // si se ha activado el flag error 
        echo "Error al subir archivo."; 
    } else { // si todo está bien 
        //Recuerda que se coge el name del archivo y no el ID
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"],
         $destino_archivo)) { // Copiar el archivo 
            echo "El archivo ha sido subido con éxito"; 
        } else { 
            echo "Error al subir el archivo."; 
        } 
    } 
}
//Para leer el archivo CSV, tenemos que poner esto fuera de las llaves de $_SERVER
    $puntero = fopen('poblacion_extranjera_catalunya.csv','r');
    $cabecera = fgetcsv($puntero);

    while(($datos = fgetcsv($puntero)) !== false){
        echo "Año: ".$datos[0]." || ";
        echo "País: ".$datos[2]." || ";
        echo "Población: ".$datos[3]."<br>";
    }

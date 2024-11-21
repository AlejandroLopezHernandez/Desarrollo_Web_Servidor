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
    if ($archivoTipoArchivo != 'json') { // si el archivo no es csv o json activar flag 
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
$ruta_archivo_subido = './dataset/inmigracion_madrid.json';
$Datos_JSON = file_get_contents($ruta_archivo_subido);
$JSON_decodificado = json_decode($Datos_JSON,false);
//Accedemos dentro del archivo JSON
$array_archivos = $JSON_decodificado->data;
foreach($array_archivos as $archivo){
    echo "Barrio: ".$archivo->distrito_nombre." || ";
    echo "Población: ".$archivo->poblacion_empadronada." || ";
    echo "Sexo: ".$archivo->sexo." || "; 
    echo "Procedencia: ".$archivo->nacionalidad." <br> ";
}
?>
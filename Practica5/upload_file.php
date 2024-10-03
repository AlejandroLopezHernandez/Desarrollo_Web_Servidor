<?php
/*
* Actividad 3
* Este script procesa la subida de un archivo con extensión csv
o json al servidor. Si el archivo existe o no tiene extensión
csv o json dará error
* La actividad hace uso de la variable global $_FILES
* The _FILES array contains following properties −
*
$_FILES['file']['name'] - The original name of the file to
be uploaded.
*
$_FILES['file']['type'] - The mime type of the file.
* $_FILES['file']['size'] - The size, in bytes, of the uploaded file.
* $_FILES['file']['tmp_name'] - The temporary filename of the
file in which the uploaded file was stored on the server.
*/

/**Variables para trabajar con el archivo subido y su ruta*/
$destino_ruta = "./dataset/"; // directorio donde se subirán los archivos
$destino_archivo = $destino_ruta .
    basename($_FILES["archivo"]["name"]); // ruta completa
$archivoTipoArchivo = strtolower(pathinfo($destino_archivo, PATHINFO_EXTENSION)); // obtenemos la extensión
$uploadOk = 1; // flag
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (file_exists($destino_archivo)) { // si el archivo existe error activar flag
        $uploadOk = 0;
    }
    if ($archivoTipoArchivo != 'csv' && $archivoTipoArchivo != 'json') { // si el archivo no es csv o json activar flag
        $uploadOk = 0;
    }
    if ($uploadOk == 0) { // si se ha activado el flag error
        echo "Error al subir archivo.";
    } else { // si todo está bien
        if (move_uploaded_file(
            $_FILES["archivo"]["tmp_name"],
            $destino_archivo
        )) { // Copiar el archivo
            echo "El archivo ha sido subido con éxito";
        } else {
            echo "Error al subir el archivo.";
        }
    }
}

<?php
//Código para subir el archivo al servidor Apache
$destino_ruta = "./dataset/"; // directorio donde se subirán los archivos
$destino_archivo = $destino_ruta . basename($_FILES["archivo_subido"]["name"]); // ruta completa, name es la clave, no hace falta cambiarlo
$archivoTipoArchivo = strtolower(pathinfo($destino_archivo, PATHINFO_EXTENSION)); // obtenemos la extensión
//$uploadOk = 1; // flag
//Esta validación es OBLIGATORIA, activa el proceso de subida
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //En archivo, hay que poner el mismo nombre que le hayamos puesto en el HTML 
    if (move_uploaded_file($_FILES["archivo_subido"]["tmp_name"], $destino_archivo)) { // Copiar el archivo
        echo "El archivo ha sido subido con éxito";
    } else {
        echo "Error al subir el archivo.";
    }
}
//Código para leer dicho archivo
$handle = fopen('libros.csv', 'r');
$cabecera = fgetcsv($handle); // quitamos la cabecera

// Procesar el resto del archivo CSV
while (($datos = fgetcsv($handle)) !== false) {
    // procesar cada línea de datos
    echo "<br>".$datos[0];

    echo " : ".$datos[1];
}

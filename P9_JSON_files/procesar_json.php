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
//Usamos la función file_get_contents para leer el contenido de un archivo como si fuera una cadena, y lo almacenamos en unaa variable
$jsonData = file_get_contents('books.json');
//json_decode() se usa para convertir una cadena json en un objeto
$data = json_decode($jsonData,true);
//Procesamos los datos del archivo JSON con un bucle
foreach ($data as $libro){
    //Y ahora procesamos cada libro
    if(isset($libro['title']) && isset ($libro['author'])){
        echo "Title: ".$libro['title'];
        echo "Writer: ".$libro['author']."<br>";
    } else {
        echo "Datos incompletos para este libro";
    }
}
?>

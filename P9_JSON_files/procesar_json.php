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
        echo "El archivo ha sido subido con éxito<br>";
    } else {
        echo "Error al subir el archivo.<br>";
    }
}
//Comprobamos si el archivo en formato JSON existe
$json_file='./dataset/books.json';
if(!file_exists($json_file)){
    echo "Error, archivo JSON no encontrado<br>";
}
//Usamos la función file_get_contents para leer el contenido de un archivo como si fuera una cadena, y lo almacenamos en unaa variable
$jsonData = file_get_contents($json_file);
//json_decode() se usa para convertir una cadena json en un objeto
$data = json_decode($jsonData,false);
//Metemos los libros dentro de un array para poder procesarlos
$array_libros = $data->books;
//Hacemos esto porque en nuestro archivo JSON primeros hay 'books' y después hay cada libro individual
//Procesamos los datos del archivo JSON con un bucle,usamos el array que hemos creado anteriormente
foreach ($array_libros as $libro){
        //Y ahora procesamos cada libro
        echo 'Title: '.$libro->title.' || ';
        echo 'Writer: '.$libro->author.'<br>';
        /*En caso de que hubiese más de un autor para cada libro, deberíamos crear un array
         para los autores y luego otro bucle foreach para procesarlo. Este bucle iría dentro del otro.

        $array_autores = $libro->author;

        foreach($array_autores as $autor){
        echo '<br>'.$autor;
        }*/
}
?>

<?php
/*1.- Abrir el archivo CSV y leer el nombre del municipio (primer campo).*/
//Primero vemos si existe dicho archivo
if (isset($_FILES['archivo_csv'])) {
    $nombre_archivo = $_FILES['archivo_csv']['name'];
    $tipo_archivo = $_FILES['archivo_csv']['type'];
    $ruta_temporal = $_FILES['archivo_csv']['tmp_name'];
    
    if(($handle = fopen($ruta_temporal, 'r')) !== false){
        echo "<table border='1'>";
        $cabecera = fgetcsv($handle); // quitamos la cabecera
        $primer_campo = fgetcsv($handle,1000,',');
        $municipio = $primer_campo[0];
        
        while(($data = fgetcsv($handle,1000,','))!== false){
            echo "<tr>";
            foreach($data as $campo){
                echo "<td>".htmlspecialchars($campo)."<td>";
            }
            echo "<tr>";
        }
        echo "</table>";
    }else {
        echo "No se pudo abrir el archivo";
    } 

//2.- Crear carpeta del municipio si no existe, NOTA: El nombre del municipio se debe poner 
$folderPath = "uploads/" . $municipio;
//2.1 Si no existe creamos la carpeta 
if (!file_exists($folderPath)) {
    mkdir($folderPath, 0777, true);
}
// Ruta final del archivo en la carpeta del municipio 
$fileDestination = $folderPath . "/ultimo_reporte.csv";
//3. Mover el archivo a la carpeta del municipio, sobrescribiendo el archivo anterior 
if(move_uploaded_file($ruta_temporal,$fileDestination)){
    echo "Archivo CSV subido correctamente a la carpeta de municipio";
}
//4.- Verificar la última fecha de actualización en la base de datos 
require_once '../Clases/repositorio_mysql.php';
$repositorio = new RepositorioMYSQL('mysql','emergencia','root','1234');
$lastUpdate = $repositorio->obtenerUltimaFechaReporte($municipio);
$newUpdate = filemtime($fileDestination); // Fecha de subida del archivo 
/*5.- Buscar palabras clave en el campo necesidades de ayuda con la 
función strpos NOTA: ESTO SE DEBE HACER POR CADA NECESIDAD ESTABLECIDA*/
}
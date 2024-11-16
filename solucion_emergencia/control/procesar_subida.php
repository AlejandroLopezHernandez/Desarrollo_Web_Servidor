
<?php
require 'RepositorioMYSQL.php';

// Configuración de la base de datos
$repositorio = new RepositorioMYSQL("mysql", "root", "1234", "emergencia");

if (isset($_FILES['archivo_csv'])) {
    $fileTempPath = $_FILES['archivo_csv']['tmp_name'];

    //1.- Abrir el archivo CSV y leer el nombre del municipio (primer campo)
    $file = fopen($fileTempPath, 'r');
    $headers = fgetcsv($file); // OJO: Saltar la línea de cabeceras
    $data = fgetcsv($file, 1000, ","); // Leer la primera línea de datos

    if ($data !== false) {
        // Obtenemos los datos uno a uno
        $municipio = $data[0];
        $personas_afectadas = (int) $data[1];
        $comunicaciones_cortadas = (int) $data[2];
        $necesidades_ayuda = $data[3];

        // Crear carpeta del municipio si no existe
        $folderPath = "uploads/" . $municipio; // El nombre del municipio se poner
        // Si no existe creamos la carpeta
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // Ruta final del archivo en la carpeta del municipio
        $fileDestination = $folderPath . "/ultimo_reporte.csv";

        // Mover el archivo a la carpeta del municipio, sobrescribiendo el archivo anterior
        if (move_uploaded_file($fileTempPath, $fileDestination)) {
            // Verificar la última fecha de actualización en la base de datos
            $lastUpdate = $repositorio->obtenerUltimaFechaReporte($municipio);
            $newUpdate = filemtime($fileDestination); // Fecha de subida del archivo

            if (is_null($lastUpdate) || $newUpdate > $lastUpdate) {
                // Si debe actualizarse, actualizar los datos en la base de datos


                // Inicializar variables para las necesidades
                $agua = 0;
                $productos_limpieza = 0;
                $viveres = 0;
                $medicinas = 0;
                $otros = '';

                // Buscar palabras clave en el campo necesidades de ayuda con la función strpos
                if (stripos($necesidades_ayuda, 'agua') !== false) {
                    $agua = 1;
                }
                if (stripos($necesidades_ayuda, 'productos limpieza') !== false) {
                    $productos_limpieza = 1;
                }
                if (stripos($necesidades_ayuda, 'viveres') !== false) {
                    $viveres = 1;
                }
                if (stripos($necesidades_ayuda, 'medicinas') !== false) {
                    $medicinas = 1;
                }
                // Asignar a $otros si no se encuentra ninguna palabra clave
                if ($agua === 0 && $productos_limpieza === 0 && $viveres === 0 && $medicinas === 0) {
                    $otros = $necesidades_ayuda;
                } 
                // Insertar o actualizar los datos en la base de datos
                $repositorio->guardarEstadoMunicipio($municipio, $personas_afectadas, $comunicaciones_cortadas, $agua, $productos_limpieza, $viveres, $medicinas, $otros);


                // Cerrar el archivo
                fclose($file);
                echo 'Archivo procesado correctamente';
            }
        } else {
            echo ' Error al copiar archivo';
        }
    }
}

// Cerrar la conexión de la base de datos
$repositorio->cerrarConexion();
?>

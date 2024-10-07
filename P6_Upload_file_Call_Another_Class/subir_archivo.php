<?php
    include 'analizador_discurso(resuelto).php';
    $destino_ruta = "./discurso/";
    $destino_archivo = $destino_ruta . basename($_FILES["archivo"]["name"]);
    $archivo_tipo_archivo = strtolower(pathinfo($destino_archivo, PATHINFO_EXTENSION));
    $subida_correcta = 1;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if($_FILES["archivo"]["error"]!== UPLOAD_ERR_OK){
            echo "Error al subir el archivo.Código de error: ".$_FILES["archivo"]["error"]."<br>";
        }
        if (file_exists($destino_archivo)) {
            $subida_correcta = 0;
        }
        if ($archivo_tipo_archivo != 'txt') {
            $subida_correcta = 0;
        }
        if ($subida_correcta == 0) {
            echo "error al subir el archivo";
        } else {
            if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino_archivo)) {
                echo "archivo subido correctamente";
            } else {
                echo "Error al subir el archivo";
            }
        }
    }
    function __construct(){}
    $analizador = new AnalizadorDeDiscurso();
    $analizador->agregarDiscurso($destino_ruta);
    $analizador->analizar();

?>
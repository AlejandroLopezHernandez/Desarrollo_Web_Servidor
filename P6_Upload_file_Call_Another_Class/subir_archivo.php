<?php
include 'analizador_discurso(resuelto).php';
$destino_ruta = "./discurso/";
$destino_archivo = $destino_ruta . basename($_FILES["archivo"]["name"]);
$discurso_texto = file_get_contents('./discurso/lorem.txt');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino_archivo)) {
        echo "archivo subido correctamente";
    } else {
        echo "Error al subir el archivo";
    }

    $analizador = new AnalizadorDeDiscurso();
    $analizador->agregarDiscurso($discurso_texto);
    $analizador->analizar();
}


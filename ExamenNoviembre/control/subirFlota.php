<?php
session_start();
if(!isset($_SESSION['usuario_administrador'])){
    header('Location: autenticar.php');
        exit;
} 
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Subir y procesar un archivo JSON</title>
    </head>
    <body>
        <form action="cargarNuevosDatosFlota.php" method="post"
        enctype="multipart/form-data">
        Selecciona ruta archivo JSON a subir:
        <!--Del atributo "name" vas a tener que usarlo con la variable $_FILES-->
        <input type="file" name="archivo_subido" id="archivo_subido" accept=".json" required>
        <!--Usa siempre la variable archivo_subido-->
        <input type="submit" value="Subir" name="Subir al servidor" required>
    </form>
    </body>
    </html>

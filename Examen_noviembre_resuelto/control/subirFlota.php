<?php
session_start();

if (!isset($_SESSION['usuario_admin'])) {
    header('Location: autenticar.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Archivo JSON - Flota</title>
</head>
<body>
    <h2> Cargar Nuevos Datos de Flota</h2>
    <form action="cargarNuevosDatosFlota.php" method="POST" enctype="multipart/form-data">
        <label for="archivo">Seleccionar archivo JSON:</label>
        <input type="file" name="archivo" id="archivo" accept="application/json" required>
        <br><br>
        <button type="submit">Subir y Procesar</button>
    </form>
</body>
</html>

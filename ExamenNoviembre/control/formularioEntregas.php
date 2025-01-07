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
    <title>Formulario de entregas pendientes</title>
</head>
<body>
    <h2>Consulta las entregas pendientes</h2>
    <form action="verEntregaspendientes.php" method="post">
    <label>Conductor(ID): </label>
    <input type="text" name="conductor_id" id="conductor_id">
    <input type="hidden" name="action" value="1">
    <br>
    <input type="submit" value="Consultar Conductor" name="Consultar Vehiculo" required>
    <br><br>
    <label>Vehículo(ID):</label>
    <input type="text" name="vehiculo_id" id="vehiculo_id">
    <input type="hidden" name="action" value="2">
    <br><br>
    <input type="submit" value="Consultar Vehiculo" name="Consultar Conductor" required>
</form>
</body>
</html>



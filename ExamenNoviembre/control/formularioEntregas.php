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
    <form action="verEntregaspendientes.php" method="GET">
    <label>Conductor(ID): </label>
    <!--Este código PHP incrustado sirve para que, en caso de existir una cookie,
        se use el valor de esta en el input -->
    <input type="text" name="conductor" id="conductor" value="<?php isset($_COOKIE['conductor'])?$_COOKIE['conductor']:'1';?>">
    <br><br>
    <label>Vehículo(ID):</label>
    <input type="text" name="vehiculo" id="vehiculo" value="<?php isset($_COOKIE['vehiculo'])?$_COOKIE['vehiculo']:'1';?>">
    <br><br>
    <input type="submit" value="Consultar" name="Consultar Conductor" required>
</form>
</body>
</html>



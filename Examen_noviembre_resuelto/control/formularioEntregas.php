
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Entregas Pendientes</title>
</head>
<body>
    <h1>Consulta de Entregas Pendientes</h1>
    <form action="verEntregaspendientes.php" method="GET">
        <label for="conductor">Conductor (ID):</label>
        <input type="text" id="conductor" name="conductor" value="<?php isset($_COOKIE['conductor'])?$_COOKIE['conductor']:'1'; ?>">
        
        <label for="vehiculo"> o Vehículo (ID):</label>
        <input type="text" id="vehiculo" name="vehiculo" value="<?php isset($_COOKIE['vehiculo'])?$_COOKIE['vehiculo']:'1'; ?>">
        
        <button type="submit">Consultar</button>
    </form>
</body>
</html>


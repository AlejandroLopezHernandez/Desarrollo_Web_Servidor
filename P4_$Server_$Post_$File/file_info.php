<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Subida de Archivos</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
Selecciona un archivo: <input type="file" name="archivo"
required><br><br>
<input type="submit" value="Subir Archivo">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$archivo = $_FILES["archivo"];
echo "Nombre del archivo: " . $archivo["name"] . "<br>";
echo "Tipo de archivo: " . $archivo["type"] . "<br>";
echo "Tamaño del archivo: " . $archivo["size"] . "
bytes<br>";
}
?>
</body>
</html>

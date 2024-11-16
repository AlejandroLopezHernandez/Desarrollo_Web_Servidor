<?php
// 1.- Manejar la configuración de preferencias
// Establecer la cookie a partir de la información enviada
// NOTA: Este código es de reentrada
if (isset($_POST['categoria'])) {
    $categoria = $_POST['categoria'];
    if(isset($_COOKIE['categoria'])){
        setcookie("categoria",$categoria, time() + 3600);
    } else {
        setcookie("categoria",$categoria, time() + 3600);
    }
}
//Ejemplo de categorías disponibles
$categorias = ['BBDD', 'Lenguajes de Programación', 'Plataformas', 'IA', 'Big Data'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Configurar Preferencias</title>
</head>

<body>
    <h2>Elige tu categoría de publicaciones preferida:</h2>
    <form action="" method="POST">
        <label for="categoria">Categoría:</label>
        <select name="categoria" id="categoria">
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?php echo $categoria; ?>"><?php echo $categoria; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Guardar Preferencias</button>
    </form>
</body>

</html>
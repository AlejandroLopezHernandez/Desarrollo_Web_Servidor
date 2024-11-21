<?php
// Manejar la configuración de preferencias
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoriaSeleccionada = $_POST['categoria'];
    
    // Establece la cookie
    setcookie('categoria_preferida', $categoriaSeleccionada, 3600, "/"); // Cookie válida por 30 días
    
    // Simula la disponibilidad inmediata de la cookie en $_COOKIE
    $_COOKIE['categoria_preferida'] = $categoriaSeleccionada;
    
    // Redirige al usuario
    header("Location: dashboardPreferencias.php");
    exit();
}
// Ejemplo de categorías disponibles


$categorias = ['BBDD', 'Lenguajes de Programacion', 'Plataformas', 'IA','Big Data'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Configurar Preferencias</title>
</head>
<body>
    <h2>Elige tu categoría de publicaciones preferida:</h2>
    <form action="./preferencias.php" method="POST">
        <label for="categoria">Categoría:</label>
        <select name="categoria" id="categoria">
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?php echo $categoria; ?>"><?php echo $categoria; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Guardar Preferencias</button>
    </form>
    <a href="./dashboardPreferencias.php" > seguir con la misma preferencia</a>
</body>
</html>

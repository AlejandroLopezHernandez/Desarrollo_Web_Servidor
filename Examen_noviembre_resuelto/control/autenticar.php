<?php

session_start(); // Iniciar o reanudar la sesión

require_once '../clases/RepositoryMySQL.php';

// Configuración de la base de datos
$host = 'mysql';
$dbname = 'FLOTA';
$username = 'root';
$password = '1234';

$repository = new RepositoryMySQL($host, $dbname, $username, $password);



// Procesar el formulario de autenticación
// Esto sólo se hace la segunda vez , es decir cuando el usuario manda el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ;
    $password = $_POST['password'] ;
    //$password_cifrada=password_hash($password,PASSWORD_DEFAULT);
    // Verificar las credenciales
    if ($repository->autenticarUsuario($usuario,$password)) {
        
        // Si las credenciales son correctas, guardamos en la sesion para luego validar la sesion mas adelante
        $_SESSION['usuario_admin'] = $usuario;
        header('Location: ../index.html');
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Autenticación</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <form action="autenticar.php" method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required>
        <br><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <br><br>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>

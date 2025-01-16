<?php
session_start();
require_once 'repositorioSQL.php';

$servidor = 'mysql';
$bbdd = 'Transporte';
$usuario = 'root';
$contraseña = '1234';
$repositorio = new Repostorio_MySQL_Transporte($servidor,$bbdd,$usuario,$contraseña);

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $usuario = $_POST['username'];
    $contraseña = $_POST['password'];
    $usuario_alex = $repositorio->conseguir_user_pass($usuario);
    
    if($usuario_alex && password_verify($contraseña,$usuario_alex['password'])){
        echo "Sesión iniciada con éxito";
        $_SESSION['usuario_administrador'] = $usuario;
        header('Location: ./indice_BBDD.html');
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Autenticación de Usuario</title>
</head>
<body>
    <h2>Iniciar sesión en Transportes</h2>
    <form action="autentificacion.php" method="post">
    <label for="username">Usuario:</label>
    <input type="text" name="username" id="username"
    required><br><br>
    <label for="password">Contraseña:</label>
    <input type="password" name="password" id="password"
    required><br><br>
    <button type="submit">Iniciar sesión</button>
</form>
</body>   
</html>
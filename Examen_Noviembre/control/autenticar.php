<?php
session_start();
require_once '../clases/RepositoryMySQL.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $repositorio = new RepositorioSQLFlotaVehiculos('mysql','FLOTA','root','1234');
    $usuario = $_POST['user'];
    $contraseña = $_POST['password'];

    $usuario_admin = $repositorio->ConseguirUsuarioYContraseña($usuario);

    if($usuario_admin && password_verify($contraseña,$usuario_admin['password'])){
        echo "Sesión iniciada con éxto";
        $_SESSION['usuario_admin'] = $usuario;
        header('Location:../index.html');
    } else {
        echo "Contraseña incorrecta";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Flota</title>
</head>
<body>
    <h1>Iniciar sesión</h1>
    <form action="autenticar.php" method="post">
        <label>Usuario</label>
        <input type="text" name="user" id="user"><br><br>
        <label>Contraseña</label>
        <input type="password" name="password" id="password"><br><br>
        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>
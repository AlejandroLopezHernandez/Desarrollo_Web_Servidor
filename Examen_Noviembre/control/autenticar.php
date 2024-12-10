<?php
session_start();
require_once '../clases/RepositoryMySQL.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $usuario_ingresado = $_POST['user'];
    $contraseña_ingresada = $_POST['password'];

    $repositorio = new RepositorioSQLFlotaVehiculos('mysql','FLOTA','root','1234');

    $ususario_bddd = $repositorio->ConseguirUsuarioYContraseña($usuario_ingresado);
    
    if($ususario_bddd){
        if(password_verify($contraseña_ingresada,$ususario_bddd['password'])){
            echo "Sesión iniciada correctamente.Bienvenido/a";
            $_SESSION['admin'] = $usuario_ingresado;
            //Poner Location es obligatorio
            header('Location: ../index.html');
            exit;
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario incorrecto";
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
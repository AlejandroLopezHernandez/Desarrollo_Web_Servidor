<?php
session_start();
require_once '../clases/RepositoryMySQL.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $repositorio = new RepositorioSQLFlota('mysql','FLOTA','root','1234');
    $usuario = $_POST['username'];
    $contraseña = $_POST['password'];
    $usuario_administrador = $repositorio->obtener_user_password($usuario);
    
    if($usuario_administrador && password_verify($contraseña,$usuario_administrador['password'])){
        echo "Sesión iniciada con éxito";
        //Creamos la cookie de sesión
        $_SESSION['usuario_administrador'] = $usuario;
        header('Location: ../index.html');
        exit;
    }else{
        echo "Usuario o contraseña incorrecto";
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
    <h2>Iniciar sesión</h2>
    <form action="autenticar.php" method="post">
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

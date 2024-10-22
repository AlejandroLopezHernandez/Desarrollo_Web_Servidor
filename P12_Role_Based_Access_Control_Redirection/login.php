<?php
session_start();
include 'modulo_roles.php';

//1.- Obtener credenciales 
$user = $_POST['username'];
$password = $_POST['password'];
$credenciales_correctas = false;
//Para meterse dentro de un array, creamos una variable y la igualamos a un array
//$array1 = $usuarios;
//Después nos metemos otra vez dentro del array con el valor entre corchetes
//$array2 = $array1["admin"];

foreach ($usuarios as $usuario => $clave) {
    //verificación de credenciales
    if ($usuario === $user && $password === $clave['password']) {
        $credenciales_correctas = true;
        //3.- Redirigir según el rol 
        if($clave['rol'] === "admin"){
            //Si es administrador 
            header('Location:modulo_admin.php');
            exit();
        } else if($clave['rol'] === "user"){
            //si es usuario normal 
            header('Location:modulo_usuario.php');
            exit();
        }
    } 
}
//Nota: antes del header, no pongas ningún echo, sácalo fuera del bucle
if(!$credenciales_correctas) {
    echo "usuario o contraseña incorrecto";
}
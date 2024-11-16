<?php
$usuarios = [
    'usuario1' => '1234',
    'admin' => 'qwerty'
];
$usuario = $_POST['usuario'];
$contraseña = $_POST['contrasenya'];

if(array_key_exists($usuario,$usuarios)&& $usuarios[$usuario]){
    header("Location: consular_estado_emergencia.php");
    exit();
} else if ($usuario_ya_verificado == false || $contraseña_ya_verificada == false){
    echo "Contraseña o usuario incorrecto";
}

<?php
// Array asociativo con usuarios y contraseñas cifradas
$users = [
    'user1' => password_hash('pd123', PASSWORD_DEFAULT),
    'user2' => password_hash('my5678', PASSWORD_DEFAULT),
    'admin' => password_hash('adminpass', PASSWORD_DEFAULT),
];
print_r($users);

$usuario = $_POST['username'];
$contraseña = $_POST['password'];

$usuario_verificado = array_key_exists($usuario, $users);
$contraseña_verificada = password_verify($contraseña, $users[$usuario]);

if ($usuario_verificado && $contraseña_verificada) {
    echo "Usuario identificado con éxito";
} else if ($usuario_verificado == false || $contraseña_verificada == false) {
    echo "Usuario o contraseña incorrecto";
}

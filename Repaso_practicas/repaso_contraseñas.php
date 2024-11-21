<?php
// Array asociativo con usuarios y contraseñas cifradas 
$users = [ 
    'alex' => password_hash('1234', PASSWORD_DEFAULT), 
    'luis' => password_hash ('qwerty', PASSWORD_DEFAULT), 
    'admin' => password_hash('contraseña', PASSWORD_DEFAULT), 
];

$usuario = $_POST['username'];
$contraseña = $_POST['password'];

if(array_key_exists($usuario,$users) && password_verify($contraseña,$users[$usuario])){
    echo "Sesión iniciada";
} else {
    echo "Error al iniciar sesión";
}
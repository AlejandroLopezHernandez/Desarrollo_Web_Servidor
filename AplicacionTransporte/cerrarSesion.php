<?php
session_start();
if(isset($_SESSION['usuario_administrador'])){
    session_destroy();
    header('Location:./indice_BBDD.html');
} else {
    echo "No se detectó inicio de sesión";
    header('Location:./autentificacion.php');
}
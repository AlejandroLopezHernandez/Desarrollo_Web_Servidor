<?php
session_start();
if($_SESSION['usuario_administrador']){
    session_destroy();
    header('Location: ../index.html');
    exit;
} else {
    echo "Sesión no iniciada";
}
<?php
session_start();
if(!isset($_SESSION['admin'])){
    header('Location: autenticar.php');
    exit;
} else {
    echo "Se ha aceptado la cookie de sesión";
}
<?php
session_start();
require_once '../clases/RepositoryMySQL.php';
if(!isset($_SESSION['usuario_administrador'])){
    header('Location: autenticar.php');
        exit;
} 
$repositorio = new RepositorioSQLFlota('mysql','FLOTA','root','1234');
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $repositorio->retrasar_entrega($_POST['localidad']);
}
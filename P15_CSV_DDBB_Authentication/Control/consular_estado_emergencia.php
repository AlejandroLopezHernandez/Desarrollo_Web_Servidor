<?php
//1.-importar clases de soporte necesarias 
require_once '../Clases/repositorio_mysql.php';
require_once '../Clases/VistaHTML.php';

$repositorio = new RepositorioMYSQL('mysql', 'emergencia', 'root', '1234');
$vista = new VistaHTML();
//2.- Obtener los municipios Afectados  
$municipios = $repositorio->mostrarInfoMunicipios();
//3.- Obtener el número total de afectados 
$afectados = $repositorio->obtenerNumeroTotalfectados();
//4.-Mostrar el resultado con la vista 
$vista->mostrarEstadoMunicipios($municipios, $afectados);
   
<?php
require_once 'clases/repositorioMYSQL.php';
require_once 'clases/VistaHTMLGrafica.php';
require_once 'preferencias.php';

// Configuración de la conexión
$repositorio = new RepositorioMYSQL_RedSocial('mysql','red_social_informatica','root','1234');
$vistaHTML = New VistaHTMLGrafica();
// 1.-Leer cookie 
$categoriaPreferida = $_COOKIE['categoria'];
//2.- Obtener datos con el filtro de preferencias

//3.- Renderizar vista de datos
$vistaHTML->renderUsuariosConMasLikes($usuariosConMasLikes);


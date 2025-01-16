<?php
require_once 'clases/repositorioMYSQL.php';
require_once 'clases/VistaHTMLSimple.php';
require_once 'preferencias.php';

// Configuración de la conexión
$repositorio = new RepositorioMYSQL_RedSocial('mysql','red_social_informatica','root','1234');
$vistaHTML = new VistaHTML();
// 1.-Leer cookie 
$categoriaPreferida = $_COOKIE['categoria'];
//2.- Obtener datos con el filtro de preferencias
$usuariosConMasSeguidores = $repositorio->ObtenerTresUsuariosMasSeguidores();
$totalPublicacionesPorUsuario = $repositorio->NumeroPublicacionesPorUsuario();
$usuarioMasPopular = $repositorio->ObtenerUsuarioMasPopular();
$usuariosConMasLikes = $repositorio->ObtenerTresUsuariosMasSeguidores();
//3.- Renderizar vista de datos
$vistaHTML->renderUsuarioMasPopular($usuarioMasPopular);
$vistaHTML->renderTotalPublicacionesPorUsuario($totalPublicacionesPorUsuario);
$vistaHTML->renderUsuariosSeguidores($usuariosConMasSeguidores);
$vistaHTML->renderUsuariosConMasLikes($usuariosConMasLikes);


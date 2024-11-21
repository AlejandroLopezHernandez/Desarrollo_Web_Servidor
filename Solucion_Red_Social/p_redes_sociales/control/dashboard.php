<?php
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTMLGrafica.php';

// Configuración de la conexión
$host = 'mysql';
$dbname = 'red_social_informatica';
$user = 'root';
$password = '1234';

$repository = new RepositoryMySQL($host, $dbname, $user, $password);
$vistaHTML= new VistaHTMLGrafica();
// Obtener datos
$usuariosConMasSeguidores = $repository->getUsuariosSeguidores();
$usuariosConMasLikes = $repository->getUsuariosConMasLikes();
$totalPublicacionesPorUsuario = $repository->getTotalPublicacionesPorUsuario();
$usuarioMasPopular=$repository->getUsuarioMasPopular();
// Renderizar vista

$vistaHTML->renderUsuarioMasPopular($usuarioMasPopular);
$vistaHTML->renderUsuariosSeguidores($usuariosConMasSeguidores);
$vistaHTML->renderUsuariosConMasLikes($usuariosConMasLikes);
$vistaHTML->renderTotalPublicacionesPorUsuario($totalPublicacionesPorUsuario);

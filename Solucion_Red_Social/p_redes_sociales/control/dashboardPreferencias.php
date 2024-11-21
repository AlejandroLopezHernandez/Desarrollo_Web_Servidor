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

// Leer preferencias de categoría del usuario desde la cookie
$categoriaPreferida = $_COOKIE['categoria_preferida'] ;
var_dump($categoriaPreferida);
// Obtener datos con el filtro de preferencias
$usuariosConMasSeguidores = $repository->getUsuariosSeguidoresCategorizado($categoriaPreferida);
$usuariosConMasLikes = $repository->getUsuariosConMasLikesCategorizado($categoriaPreferida);
$totalPublicacionesPorUsuario = $repository->getTotalPublicacionesPorUsuarioCategorizado($categoriaPreferida);
$usuarioMasPopular = $repository->getUsuarioMasPopularCategorizado($categoriaPreferida);


$vistaHTML->renderUsuarioMasPopular($usuarioMasPopular);
$vistaHTML->renderUsuariosSeguidores($usuariosConMasSeguidores);
$vistaHTML->renderUsuariosConMasLikes($usuariosConMasLikes);
$vistaHTML->renderTotalPublicacionesPorUsuario($totalPublicacionesPorUsuario);


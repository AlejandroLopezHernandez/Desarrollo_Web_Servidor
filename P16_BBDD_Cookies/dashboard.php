<?php
require_once 'clases/repositorioMYSQL.php';
require_once 'clases/VistaHTMLSimple.php';
//1.- Configuración de la conexión
$repositorio = new RepositorioMYSQL_RedSocial('mysql', 'red_social_informatica', 'root', '1234');
$vista = new VistaHTML();
//2.- Obtener datos
$tresUsuarioMasSeguidores = $repositorio->ObtenerTresUsuariosMasSeguidores();
$tresUsuarioMasLike = $repositorio->ObtenerTresUsuariosMasLikes();
$tresUsuarioMasPublicaciones = $repositorio->NumeroPublicacionesPorUsuario();
$UsuarioMasPopular = $repositorio->ObtenerUsuarioMasPopular();
//3.- Renderizar vista
$vista->renderUsuariosSeguidores($tresUsuarioMasSeguidores);
$vista->renderUsuariosConMasLikes($tresUsuarioMasLike);
$vista->renderTotalPublicacionesPorUsuario($tresUsuarioMasPublicaciones);
$vista->renderUsuarioMasPopular($UsuarioMasPopular);

var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));

<?php
interface VistaHTMLInterface
{
    public static function renderUsuarioMasPopular($usuario);
    public static function renderUsuariosSeguidores($usuarios);
    public static function renderUsuariosConMasLikes($usuarios);
    public static function renderTotalPublicacionesPorUsuario($usuarios);
}

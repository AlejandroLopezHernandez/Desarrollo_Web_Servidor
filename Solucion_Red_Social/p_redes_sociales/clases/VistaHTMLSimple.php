<?php
require_once 'VistaHTMLInterface.php';
class VistaHTML implements VistaHTMLInterface {

    public static function renderChartScripts(){}
    public static function renderUsuarioMasPopular($usuario) {
       
            echo "<li>{$usuario['nombre_usuario']} - Seguidores: {$usuario['seguidores']}</li>";
        
        echo "</ul>";
    }
    public static function renderUsuariosSeguidores($usuarios) {
        echo "<h3>Usuarios y seguidores</h3><ul>";
        foreach ($usuarios as $usuario) {
            echo "<li>{$usuario['nombre_usuario']} - Seguidores: {$usuario['seguidores']}</li>";
        }
        echo "</ul>";
    }

    public static function renderUsuariosConMasLikes($usuarios) {
        echo "<h3>Usuarios con más 'likes'</h3><ul>";
        foreach ($usuarios as $usuario) {
            echo "<li>{$usuario['nombre_usuario']} - Total de 'me gusta': {$usuario['total_likes']}</li>";
        }
        echo "</ul>";
    }

    public static function renderTotalPublicacionesPorUsuario($usuarios) {
        echo "<h3>Total de publicaciones por usuario</h3><ul>";
        foreach ($usuarios as $usuario) {
            echo "<li>{$usuario['nombre_usuario']} - Publicaciones: {$usuario['total_publicaciones']}</li>";
        }
        echo "</ul>";
    }
}


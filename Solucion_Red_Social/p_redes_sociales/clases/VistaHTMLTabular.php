
<?php
require_once 'VistaHTMLInterface.php';
class VistaHTML implements VistaHTMLInterface{
    public static function renderChartScripts(){}
public static function renderStyles() {
    echo "<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }
        h3 {
            color: #2c3e50;
            font-size: 1.5em;
            text-align: center;
            margin-top: 20px;
        }
        ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        li {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px 15px;
            margin: 5px;
            width: 80%;
            max-width: 500px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            font-size: 1.1em;
            color: #34495e;
        }
        li:hover {
            background-color: #ecf0f1;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
        }
    </style>";
}

public static function renderUsuarioMasPopular($usuario) {
    self::renderStyles();
    echo "<h3>Usuario más popular</h3><ul>";
    echo "<li>{$usuario['nombre_usuario']} - Seguidores: {$usuario['seguidores']}</li>";
    echo "</ul>";
}

public static function renderUsuariosSeguidores($usuarios) {
    self::renderStyles();
    echo "<h3>Usuarios y seguidores</h3><ul>";
    foreach ($usuarios as $usuario) {
        echo "<li>{$usuario['nombre_usuario']} - Seguidores: {$usuario['seguidores']}</li>";
    }
    echo "</ul>";
}

public static function renderUsuariosConMasLikes($usuarios) {
    self::renderStyles();
    echo "<h3>Usuarios con más 'likes'</h3><ul>";
    foreach ($usuarios as $usuario) {
        echo "<li>{$usuario['nombre_usuario']} - Total de 'me gusta': {$usuario['total_likes']}</li>";
    }
    echo "</ul>";
}

public static function renderTotalPublicacionesPorUsuario($usuarios) {
    self::renderStyles();
    echo "<h3>Total de publicaciones por usuario</h3><ul>";
    foreach ($usuarios as $usuario) {
        echo "<li>{$usuario['nombre_usuario']} - Publicaciones: {$usuario['total_publicaciones']}</li>";
    }
    echo "</ul>";
}
}

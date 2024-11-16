<?php
require_once 'VistaHTMLInterface.php';
class VistaHTMLGrafica implements VistaHTMLInterface
{

    private static function renderChartScripts()
    {
        echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
        echo '<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
            margin: 0;
        }
        canvas {
            max-width: 600px;
            margin: 20px auto;
        }
    </style>';
    }

    public static function renderUsuarioMasPopular($usuario)
    {
        self::renderChartScripts();
        echo "<h3>Usuario más popular</h3>";
        echo "<canvas id='chartUsuarioMasPopular'></canvas>";
        echo "<script>
        const ctx = document.getElementById('chartUsuarioMasPopular').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['{$usuario['nombre_usuario']}'],
                datasets: [{
                    label: 'Seguidores',
                    data: [{$usuario['seguidores']}],
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>";
    }

    public static function renderUsuariosSeguidores($usuarios)
    {
        self::renderChartScripts();
        echo "<h3>Usuarios y seguidores</h3>";
        echo "<canvas id='chartUsuariosSeguidores'></canvas>";
        $nombres = json_encode(array_column($usuarios, 'nombre_usuario'));
        $seguidores = json_encode(array_column($usuarios, 'seguidores'));
        echo "<script>
        const ctx2 = document.getElementById('chartUsuariosSeguidores').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: $nombres,
                datasets: [{
                    label: 'Seguidores',
                    data: $seguidores,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>";
    }

    public static function renderUsuariosConMasLikes($usuarios)
    {
        self::renderChartScripts();
        echo "<h3>Usuarios con más 'likes'</h3>";
        echo "<canvas id='chartUsuariosConMasLikes'></canvas>";
        $nombres = json_encode(array_column($usuarios, 'nombre_usuario'));
        $likes = json_encode(array_column($usuarios, 'total_likes'));
        echo "<script>
        const ctx3 = document.getElementById('chartUsuariosConMasLikes').getContext('2d');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: $nombres,
                datasets: [{
                    label: 'Total de Likes',
                    data: $likes,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>";
    }

    public static function renderTotalPublicacionesPorUsuario($usuarios)
    {
        self::renderChartScripts();
        echo "<h3>Total de publicaciones por usuario</h3>";
        echo "<canvas id='chartTotalPublicacionesPorUsuario'></canvas>";
        $nombres = json_encode(array_column($usuarios, 'nombre_usuario'));
        $publicaciones = json_encode(array_column($usuarios, 'total_publicaciones'));
        echo "<script>
        const ctx4 = document.getElementById('chartTotalPublicacionesPorUsuario').getContext('2d');
        new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: $nombres,
                datasets: [{
                    label: 'Total de Publicaciones',
                    data: $publicaciones,
                    backgroundColor: 'rgba(153, 102, 255, 0.5)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>";
    }
}

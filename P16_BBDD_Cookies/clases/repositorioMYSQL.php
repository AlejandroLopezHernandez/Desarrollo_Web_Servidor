<?php
class RepositorioMYSQL_RedSocial
{
    private $conexion;
    //Ten mucho cuidado con el constructor
    public function __construct($host, $db, $usuario, $contraseña)
    {
        $this->conexion = new PDO(
            'mysql:host=' . $host . ';dbname=' . $db,
            $usuario,
            $contraseña
        );
        $this->conexion->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }
    public function ObtenerTresUsuariosMasSeguidores()
    {
        $sql = "SELECT *
            FROM usuarios
            ORDER BY seguidores DESC
            LIMIT 3";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ObtenerTresUsuariosMasLikes()
    {
        $sql = 'SELECT u.nombre_usuario,SUM(p.likes) AS "total_likes"
            FROM usuarios u
            INNER JOIN publicaciones p 
            ON p.id_usuario = u.id_usuario
            GROUP BY u.nombre_usuario
            ORDER BY total_likes DESC
            LIMIT 3';
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function NumeroPublicacionesPorUsuario()
    {
        $sql = "SELECT COUNT(id_publicacion) AS publicaciones, u.nombre_usuario
            FROM usuarios u
            INNER JOIN publicaciones p
            ON u.id_usuario = p.id_usuario
            GROUP BY u.id_usuario";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ObtenerUsuarioMasPopular()
    {
        $sql = "SELECT nombre_usuario,seguidores
            FROM usuarios
            ORDER BY seguidores DESC
            LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

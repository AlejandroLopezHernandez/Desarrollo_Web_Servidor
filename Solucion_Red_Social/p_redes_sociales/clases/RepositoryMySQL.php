<?php

class RepositoryMySQL
{
    private $conn;

    public function __construct($host, $dbname, $user, $password)
    {
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
        }
    }

    public function getUsuariosSeguidores($limite = 5)
    {
        $stmt = $this->conn->prepare("SELECT u.nombre_usuario, COUNT(s.id_seguidor) AS seguidores 
                                     FROM usuarios u 
                                     LEFT JOIN seguir_a s ON u.id_usuario = s.id_seguido 
                                     GROUP BY u.id_usuario 
                                     ORDER BY seguidores DESC 
                                     LIMIT :limite");
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuarioMasPopular()
    {
        $stmt = $this->conn->prepare("
        SELECT u.nombre_usuario, COUNT(s.id_seguidor) AS seguidores 
        FROM usuarios u 
        LEFT JOIN seguir_a s ON u.id_usuario = s.id_seguido 
        GROUP BY u.id_usuario 
        ORDER BY seguidores DESC 
        
    ");
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ? $resultado : null;
    }

    public function getUsuariosConMasLikes($limite = 5)
    {
        $stmt = $this->conn->prepare("
            SELECT u.nombre_usuario, SUM(p.likes) AS total_likes
            FROM usuarios u
            JOIN publicaciones p ON u.id_usuario = p.id_usuario
            GROUP BY u.id_usuario
            ORDER BY total_likes DESC
            LIMIT :limite
        ");
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalPublicacionesPorUsuario()
    {
        $stmt = $this->conn->query("SELECT u.nombre_usuario, COUNT(p.id_publicacion) AS total_publicaciones 
                                   FROM usuarios u 
                                   LEFT JOIN publicaciones p ON u.id_usuario = p.id_usuario 
                                   GROUP BY u.id_usuario");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuariosSeguidoresCategorizado($categoria = null)
    {
        $query = "SELECT u.nombre_usuario, COUNT(s.id_seguidor) AS seguidores 
                  FROM usuarios u ,seguir_a s,publicaciones p
                    WHERE u.id_usuario = s.id_seguido
                    AND p.id_usuario=u.id_usuario
                    AND p.categoria = :categoria
                    GROUP BY u.id_usuario ORDER BY seguidores DESC";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuariosConMasLikesCategorizado($categoria = null)
    {
        $query = "SELECT u.nombre_usuario, COUNT(p.likes) AS total_likes 
                  FROM usuarios u 
                  LEFT JOIN publicaciones p ON u.id_usuario = p.id_usuario
                  WHERE    p.categoria = :categoria
                  GROUP BY u.id_usuario 
                  ORDER BY total_likes DESC";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalPublicacionesPorUsuarioCategorizado($categoria = null)
    {
        $query = "SELECT u.nombre_usuario, COUNT(p.id_publicacion) AS total_publicaciones 
                  FROM usuarios u 
                  LEFT JOIN publicaciones p ON u.id_usuario = p.id_usuario 
                  WHERE p.categoria = :categoria 
                  GROUP BY u.id_usuario ORDER BY total_publicaciones DESC";


        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuarioMasPopularCategorizado($categoria = null)
    {
        $query = "SELECT u.nombre_usuario, COUNT(s.id_seguidor) AS seguidores 
                  FROM usuarios u , seguir_a s , publicaciones p
                    WHERE u.id_usuario = s.id_seguido 
                  AND p.categoria = :categoria 
                  AND u.id_usuario=p.id_usuario
                  GROUP BY u.id_usuario ORDER BY seguidores DESC LIMIT 1";


        $stmt = $this->conn->prepare($query);
        
            $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
       
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

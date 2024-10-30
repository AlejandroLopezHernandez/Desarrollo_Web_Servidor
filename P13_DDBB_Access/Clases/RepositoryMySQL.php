<?php
require 'vendor/autoload.php';
require_once 'RPGRepositoryInterface.php';
class RPGRepositoryMySQL implements RPGRepositoryInterface
{
    private $conn; // Conexión a MYSQL
    // Constructor con los parámetros de conexión
    public function __construct(
        $servername,
        $dbname,
        $username,
        $password
    ) {
        // Crear conexión
        $this->conn = new PDO(
            "mysql:host=$servername;dbname=$dbname",
            $username,
            $password
        );
        // Establecer el modo de error de PDO a excepción
        $this->conn->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }
    // Implementación para encontrar una quest por su nombre
    public function findQuestByName(string $name): mixed
    {
        $consulta_hazaña_sql = "
        SELECT name
        FROM quests
        WHERE name = $name";
        $consulta_hazaña_sql = $this->conn->prepare($consulta_hazaña_sql);
        $consulta_hazaña_sql->execute(['name' => $name]);
        return $consulta_hazaña_sql->fetchAll(PDO::FETCH_ASSOC);
    }
    // Implementación para obtener todas las quests
    public function findAllQuests(): array
    {
        $sql = "SELECT * FROM quests";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Implementación para obtener todos los personajes
    public function findAllCharacters(): array
    {
        $sql = "SELECT * FROM characters";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Implementación para obtener las quests asociadas a un personaje por su ID
    public function findQuestsByCharacterName(string $name): array
    {
        $sql = "
        SELECT q.*
        FROM quests q
        JOIN character_quests cq 
        ON q.id = cq.quest_id
        JOIN characters c
        ON c.id = cq.character_id
        WHERE c.name = :name
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Implementación para encontrar un personaje por su nombre
    public function findCharacterByName(string $name): mixed
    {
        $consulta_personaje_sql = "
        SELECT name
        FROM characters
        WHERE name = :name";

        $consulta_personaje_sql = $this->conn->prepare($consulta_personaje_sql);
        $consulta_personaje_sql->execute(['name' => $name]);
        return $consulta_personaje_sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCharacter(string $name, int $level, int $experience, int $health)
    {
        $sql_add = "
        INSERT INTO characters(name,level,experience,health) VALUES
        (:name,:level,:experience,:health)
        ";
        //Parametrizamos la inserción
        $stmt = $this->conn->prepare($sql_add);
        //Vinculaamos los valores a los marcados de posición
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':level',$level, PDO::PARAM_INT);
        $stmt->bindParam(':experience',$experience, PDO::PARAM_INT);
        $stmt->bindParam(':health',$health, PDO::PARAM_INT);

        //Ejecutamos la inserción
        $resultado = $stmt->execute();

        if($resultado){
        return "Personaje añadido con éxito";
        } else {
            return "Error al añadir personaje: ".implode(" ",$stmt->errorInfo());
        }
    }
}

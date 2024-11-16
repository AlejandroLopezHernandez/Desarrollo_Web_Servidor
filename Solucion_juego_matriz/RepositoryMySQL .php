<?php
require 'vendor/autoload.php';


class RepositoryMySQL
{
    private $conn; // Conexión a MYSQL


    // Constructor con los parámetros de conexión
    public function __construct($servername, $dbname, $username, $password)
    {
        // Crear conexión

        $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Establecer el modo de error de PDO a excepción
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function saveGame($points): int
    {

        $sql = "INSERT INTO game (score, date_session) VALUES (:score, NOW())";
        $stmt = $this->conn->prepare($sql);

        // Vincular parámetros

        $stmt->bindParam(':points', $points, PDO::PARAM_INT);


        // Ejecutar la consulta
        if ($stmt->execute()) {
            return 1; // Retorna 1 de un nuevo registro
        } else {
            return 0;
        }
    }

    public function findAllScores(): array
    {
        $sql = "SELECT * FROM game ORDER BY date_session DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

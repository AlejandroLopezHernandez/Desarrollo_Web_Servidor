<?php
class Repositorio_BBDD
{
    //Establecemos la conexión con la BBDD
    private $conexion;
    //Creamos el constructor
    public function __construct($servername, $dbname, $username, $password)
    {
        $this->conexion = new PDO(
            "mysql:host= $servername;
            dbaname=$dbname",
            $username,
            $password
        );
        $this->conexion->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }
    public function sacar_todos_datos(): array
    {
        $consulta = "SELECT * FROM game";
        $stmt = $this->conexion->query($consulta);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


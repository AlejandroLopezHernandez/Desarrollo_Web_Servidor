<?php
class Repositorio_BBDD
{
    //Establecemos la conexión con la BBDD
    private $conexion;
    //Creamos el constructor, mucha atención a las comillas. Las variables deben cambiar de color
    public function __construct($servername, $dbname, $username, $password)
    {
        $this->conexion = new PDO(
            'mysql:host='. $servername .';dbname='.$dbname,$username,$password);
        $this->conexion->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }
    public function sacar_todos_datos(): array
    {
        $consulta = "SELECT * FROM game ORDER BY date_session DESC";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //Función para guardar la partida, si la fecha da problemas, la quitamos
    public function guardar_partida($puntos): int
    {
        $insercion = "INSERT INTO game(score,date_session) VALUES(:score,NOW())";
        $stmt = $this->conexion->prepare($insercion);
        //Vincular parámetros
        $stmt->bindParam(':score',$puntos, PDO::PARAM_INT);

        //Ejecutamos la inserción y devolvemos el último ID
        if($stmt ->execute()){
            return $this->conexion->lastInsertId();
        } else {
            //Si la inserción falla, se devuelve 0
            return 0;
        }
}
}


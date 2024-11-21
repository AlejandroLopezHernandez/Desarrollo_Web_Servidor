<?php
class repositorio_juego{
    private $conexion;
     public function __construct(
        $servidor,
        $nombre_bbdd,
        $usuario,
        $contraseña
      ){
        $this->conexion = new PDO(
            "mysql:host=$servidor;dbname=$nombre_bbdd",
            $usuario,
            $contraseña
        );
        $this->conexion->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
      }
      public function InsertarPuntuacion($score){
        $insercion = "
        INSERT INTO game(score)
        VALUES(:score)";
        $insercion_parametrizada = $this->conexion->prepare($insercion);
        $insercion_parametrizada->bindParam(':score',$score);
        $resultado = $insercion_parametrizada->execute();
        if($resultado){
            echo "Puntuación insertada";
        } else {
            echo "Error al insertar puntuación";
        }
      }
      public function SacarPuntuacion(){
        $consulta = "SELECT * FROM game";

        $consulta_parametrizada = $this->conexion->prepare($consulta);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetchAll(PDO::FETCH_ASSOC);
      }
    } 

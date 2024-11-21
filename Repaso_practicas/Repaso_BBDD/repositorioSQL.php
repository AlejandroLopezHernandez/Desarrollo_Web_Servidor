<?php
class Repostorio_MySQL_Transporte{

    private $conexion;

    public function __construct(
        $servername,
        $dbname,
        $username,
        $password
    ){
        $this->conexion = new PDO(
            "mysql:host=$servername;dbname=$dbname",
            $username,
            $password
        );
        $this->conexion->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }
    public function buscarAvionPorNombre(string $nombre_avion){
        $consulta_avion = "
        SELECT a.*
        FROM AVION a 
        INNER JOIN VEHICULO v 
        ON a.identificador  = v.identificador
        WHERE v.nombre = :nombre";

        $consulta_final = $this->conexion->prepare($consulta_avion);
        $consulta_final->execute(['nombre'=>$nombre_avion]);
        return $consulta_final->fetchAll(PDO::FETCH_ASSOC);
    }
    public function buscarBarcoPorNombre(string $nombre_barco){
        $consulta_barco = "
        SELECT b.*
        FROM BARCO b 
        INNER JOIN VEHICULO v 
        ON v.identificador = b.identificador
        WHERE v.nombre = :nombre";

        $consulta_final = $this->conexion->prepare($consulta_barco);
        $consulta_final->execute(['nombre'=>$nombre_barco]);
        return $consulta_final->fetchAll(PDO::FETCH_ASSOC);
    }
    public function MostrarBarcos(){
        $consulta_todos_barcos = "
        SELECT v.nombre ,b.*
        FROM BARCO b 
        INNER JOIN VEHICULO v 
        ON v.identificador = b.identificador
        ";
        $consulta_final = $this->conexion->prepare($consulta_todos_barcos);
        $consulta_final->execute();
        return $consulta_final->fetchAll(PDO::FETCH_ASSOC);
    }
}

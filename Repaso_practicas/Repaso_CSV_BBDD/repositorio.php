<?php
class Repositorio_inmigracion{
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
public function InsertarDatos($año,$codigo_pais,$pais,$poblacion){
$insercion = "
    INSERT INTO datos_inmigracion(Any,Codi_Pays,Nacionalitat,Poblaci)
    VALUES(:año,:codigo_pais,:pais,:poblacion)";

    $insercion_parametrizada = $this->conexion->prepare($insercion);
    
    $insercion_parametrizada->bindParam(':año',$año);
    $insercion_parametrizada->bindParam(':codigo_pais',$codigo_pais);
    $insercion_parametrizada->bindParam(':pais',$pais);
    $insercion_parametrizada->bindParam(':poblacion',$poblacion);

    $resultado = $insercion_parametrizada->execute();

    if($resultado){
        echo "Inserción realizada con éxito";
    } else {
        echo "Error al realizar la inserción";
    }
}
public function MostrarDatos(){
    $consulta = "SELECT * FROM datos_inmigracion";

    $consulta_parametrizada = $this->conexion->prepare($consulta);
    $consulta_parametrizada->execute();
    return $consulta_parametrizada->fetchAll(PDO::FETCH_ASSOC);
}
}
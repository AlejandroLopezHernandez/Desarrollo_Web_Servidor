<?php
class RepositorioSQLFlota{
    private $conexion;
    public function __construct($servername,$dbname,$username,$password){
    $this->conexion = new PDO('mysql:host='.$servername.';dbname='.$dbname,$username,$password);
    $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    public function obtener_user_password($usuario){
        $consulta = "SELECT * 
                    FROM ADMINISTRADOR
                    WHERE id_admin = :usuario";
        $consulta_parametrizada = $this->conexion->prepare($consulta);
        $consulta_parametrizada->bindParam(':usuario',$usuario,PDO::PARAM_STR);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
    }
    public function vehiculos_disponibles(){
        $consulta = "SELECT COUNT(*) AS 'Disponibles'
                    FROM VEHICULO v
                    INNER JOIN ENTREGA e
                    ON v.id_vehiculo = e.id_vehiculo
                    WHERE tiempo_real IS NULL";
        $consulta_parametrizada = $this->conexion->prepare($consulta);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
}
public function vehiculos_no_disponibles(){
    $consulta = "SELECT COUNT(*) AS 'No disponibles'
                FROM VEHICULO 
                WHERE id_vehiculo IN (SELECT id_vehiculo FROM ENTREGA WHERE tiempo_real IS NULL)";
    $consulta_parametrizada = $this->conexion->prepare($consulta);
    $consulta_parametrizada->execute();
    return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
}
public function vehiculos_pendientes(){
    $consulta = "SELECT COUNT(*) AS 'Pendientes'
                FROM VEHICULO v
                INNER JOIN ENTREGA e
                ON v.id_vehiculo = e.id_vehiculo
                WHERE tiempo_real IS NULL";
    $consulta_parametrizada = $this->conexion->prepare($consulta);
    $consulta_parametrizada->execute();
    return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
}
public function promedio_tiempo_real(){
    $consulta = "SELECT AVG(tiempo_real) AS 'Promedio de tiempo real'
                FROM ENTREGA
                WHERE tiempo_real IS NOT NULL";
    $consulta_parametrizada = $this->conexion->prepare($consulta);
    $consulta_parametrizada->execute();
    return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
}
public function promedio_tiempo_maximo(){
    $consulta = "SELECT AVG(tiempo_maximo) AS 'Promedio de tiempo maximo'
                FROM ENTREGA
                WHERE tiempo_maximo IS NOT NULL";
    $consulta_parametrizada = $this->conexion->prepare($consulta);
    $consulta_parametrizada->execute();
    return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
}
public function datos_mantenimiento(){
    $consulta = "SELECT matricula,kilometros AS 'KMs recorridos',1000 - kilometros AS 'KMs para mantenimiento'
                FROM ENTREGA e
                INNER JOIN VEHICULO v
                ON e.id_vehiculo = v.id_vehiculo";
    $consulta_parametrizada = $this->conexion->prepare($consulta);
    $consulta_parametrizada->execute();
    return $consulta_parametrizada->fetchAll(PDO::FETCH_ASSOC);
}
public function ciudad_max_entregas(){
    $consulta = "SELECT localidad, COUNT(id)
                FROM ENTREGA
                GROUP BY localidad
                ORDER BY localidad desc
                limit 1";
    $consulta_parametrizada = $this->conexion->prepare($consulta);
    $consulta_parametrizada->execute();
    return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
}
public function coste_conductores(){
    $consulta = "SELECT distinct nombre,SUM(kilometros * 2) AS 'Coste'
                FROM CONDUCTOR c
                INNER JOIN ENTREGA e
                ON c.id_conductor = e.id_conductor
                GROUP BY c.id_conductor";
    $consulta_parametrizada = $this->conexion->prepare($consulta);
    $consulta_parametrizada->execute();
    return $consulta_parametrizada->fetchAll(PDO::FETCH_ASSOC);
}
public function vehiculos_en_ruta(){
    $consulta = "SELECT matricula AS 'Vehiculos en ruta',
                coordenada_x, coordenada_y
                FROM ENTREGA e
                INNER JOIN VEHICULO v
                ON e.id_vehiculo = v.id_vehiculo
                WHERE tiempo_real IS NULL";
    $consulta_parametrizada = $this->conexion->prepare($consulta);
    $consulta_parametrizada->execute();
    return $consulta_parametrizada->fetchAll(PDO::FETCH_ASSOC);
}
public function insertar_vehiculo($id,$matricula,$tipo,$alarma,$coordenada_x,$coordenada_y){
    $insercion = "
    INSERT INTO VEHICULO(id_vehiculo,matricula,tipo,alarma_revision,coordenada_x,coordenada_y)
    VALUES(:id,:matricula,:tipo,:alarma,:coordenada_x,:coordenada_y)";

    $insercion_parametrizada = $this->conexion->prepare($insercion);
    
    $insercion_parametrizada->bindParam(':id',$id);
    $insercion_parametrizada->bindParam(':matricula',$matricula);
    $insercion_parametrizada->bindParam(':tipo',$tipo);
    $insercion_parametrizada->bindParam(':alarma',$alarma);
    $insercion_parametrizada->bindParam(':coordenada_x',$coordenada_x);
    $insercion_parametrizada->bindParam(':coordenada_y',$coordenada_y);

    $resultado = $insercion_parametrizada->execute();

    if($resultado){
        echo "Inserción realizada con éxito<br>";
    } else {
    echo "Error al realizar la inserción<br>";
    }
}
public function insertar_conductor($id,$nombre,$telefono){
    $insercion = "
    INSERT INTO CONDUCTOR(id_conductor,nombre,telefono)
    VALUES(:id,:nombre,:telefono)";

    $insercion_parametrizada = $this->conexion->prepare($insercion);
    
    $insercion_parametrizada->bindParam(':id',$id);
    $insercion_parametrizada->bindParam(':nombre',$nombre);
    $insercion_parametrizada->bindParam(':telefono',$telefono);

    $resultado = $insercion_parametrizada->execute();

    if($resultado){
        echo "Inserción realizada con éxito<br>";
    } else {
        echo "Error al realizar la inserción<br>";
    }
}
public function insertar_log($id,$fecha,$vehiculos,$conductores){
    $insercion = "
    INSERT INTO LOG(id_admin,fecha_subida,num_vehiculos_nuevos,num_conductores_nuevos)
    VALUES(:id,:fecha,:vehiculos,:conductores)";

    $insercion_parametrizada = $this->conexion->prepare($insercion);
    
    $insercion_parametrizada->bindParam(':id',$id);
    $insercion_parametrizada->bindParam(':fecha',$fecha);
    $insercion_parametrizada->bindParam(':vehiculos',$vehiculos);
    $insercion_parametrizada->bindParam(':conductores',$conductores);

    $resultado = $insercion_parametrizada->execute();
    if($resultado){
        echo "Inserción realizada con éxito en la tabla LOG<br>";
    } else {
        echo "Error al realizar la inserción<br>";
    }
}
public function vehiculos_revision(){
    $consulta = "SELECT matricula
                    FROM VEHICULO v
                    INNER JOIN ENTREGA e
                    ON v.id_vehiculo = e.id_vehiculo
                    GROUP BY v.id_vehiculo
                    HAVING SUM(kilometros) > 1000";
    $consulta_parametrizada = $this->conexion->prepare($consulta);
    $consulta_parametrizada->execute();
    return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
}
public function buscar_conductor_x_id($id){
    $consulta = "SELECT v.id_vehiculo AS 'id', matricula,nombre,localidad,kilometros,tiempo_maximo
                FROM VEHICULO v
                INNER JOIN ENTREGA e
                ON v.id_vehiculo = e.id_vehiculo
                INNER JOIN CONDUCTOR c
                ON c.id_conductor = e.id_conductor
                WHERE tiempo_real IS NULL
                AND v.id_vehiculo = :id";
    $consulta_parametrizada = $this->conexion->prepare($consulta);
    $consulta_parametrizada->bindParam(':id',$id,PDO::PARAM_STR);
    $consulta_parametrizada->execute();
    return $consulta_parametrizada->fetchAll(PDO::FETCH_ASSOC);
}
public function buscar_vehiculo_x_id($id){
    $consulta = "SELECT v.id_vehiculo AS 'id', matricula,nombre,localidad,kilometros,tiempo_maximo
                FROM VEHICULO v
                INNER JOIN ENTREGA e
                ON v.id_vehiculo = e.id_vehiculo
                INNER JOIN CONDUCTOR c
                ON c.id_conductor = e.id_conductor
                WHERE tiempo_real IS NULL
                AND v.id_vehiculo = :id";
    $consulta_parametrizada = $this->conexion->prepare($consulta);
    $consulta_parametrizada->bindParam(':id',$id,PDO::PARAM_STR);
    $consulta_parametrizada->execute();
    return $consulta_parametrizada->fetchAll(PDO::FETCH_ASSOC);
}
public function retrasar_entrega($localidad){
    $actualizacion = "UPDATE ENTREGA
                    SET tiempo_maximo = tiempo_maximo * 1.20
                    WHERE localidad = :localidad";
    $actualizacion_parametrizada = $this->conexion->prepare($actualizacion);
    $actualizacion_parametrizada->bindParam(':localidad',$localidad,PDO::PARAM_STR);
    $actualizacion_parametrizada->execute();

    if($actualizacion_parametrizada){
        echo "Actualizado el tiempo de entrega máximo de: ".$localidad;
    }else {
        echo "Error al actualizar";
    }
}
public function insertar_datos_conductor_csv($id,$nombre,$telefono){
    $insercion = "
    INSERT INTO CONDUCTOR(id_conductor,nombre,telefono)
    VALUES(:id,:nombre,:telefono)";

    $insercion_parametrizada = $this->conexion->prepare($insercion);
    
    $insercion_parametrizada->bindParam(':id',$id);
    $insercion_parametrizada->bindParam(':nombre',$nombre);
    $insercion_parametrizada->bindParam(':telefono',$telefono);

    $resultado = $insercion_parametrizada->execute();

    if($resultado){
        echo "Inserción realizada con éxito <br>";
        echo "<br>";
    } else {
        echo "Error al realizar la inserción<br>";
        echo "<br>";
    }
}
}

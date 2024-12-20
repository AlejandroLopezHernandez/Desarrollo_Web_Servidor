<?php
class RepositorioSQLFlotaVehiculos{
    private $conexion;
    public function __construct($servername,$dbname,$username,$password){
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
    public function ConseguirUsuarioYContraseña($usuario){
        $consulta_sql ="
        SELECT *
        FROM ADMINISTRADOR
        WHERE id_admin = :username";
        $consulta_parametrizada = $this->conexion->prepare($consulta_sql);
        $consulta_parametrizada->bindParam(':username',$usuario,PDO::PARAM_STR);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
    }
    public function VehiculosNoDisponibles(){

        $consulta_sql = "SELECT COUNT(DISTINCT v.id_vehiculo) AS 'No disponibles'
                        FROM VEHICULO v
                        INNER JOIN ENTREGA e
                        ON v.id_vehiculo = e.id_vehiculo
                        WHERE tiempo_real IS NOT NULL";
        $consulta_parametrizada = $this->conexion->prepare($consulta_sql);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
    }
    public function VehiculosDisponibles(){

        $consulta_sql = "SELECT COUNT(*) AS 'Disponibles'
                        FROM VEHICULO v
                        INNER JOIN ENTREGA e
                        ON v.id_vehiculo = e.id_vehiculo
                        WHERE tiempo_real IS NULL";
        $consulta_parametrizada = $this->conexion->prepare($consulta_sql);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
    }
    public function EntregasPendientes(){

        $consulta_sql = "SELECT COUNT(*) AS 'Entregas pendientes'
                        FROM ENTREGA
                        WHERE tiempo_real IS NULL";
        $consulta_parametrizada = $this->conexion->prepare($consulta_sql);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
    }
    public function TiemposEntregaReal(){

        $consulta_sql = "SELECT AVG(tiempo_real) AS 'Tiempo promedio entrega real'
                        FROM ENTREGA
                        WHERE tiempo_maximo - tiempo_real";
        $consulta_parametrizada = $this->conexion->prepare($consulta_sql);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
    }
    public function TiemposEntregaMaximo(){

        $consulta_sql = "SELECT AVG(tiempo_maximo) AS 'Tiempo promedio entrega maximo'
                        FROM ENTREGA
                        WHERE tiempo_real - tiempo_maximo";
        $consulta_parametrizada = $this->conexion->prepare($consulta_sql);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
    }
    public function EntregasATiempo(){

        $consulta_sql = "SELECT COUNT(*) AS 'Entregas a tiempo'
                        FROM ENTREGA
                        WHERE tiempo_real - tiempo_maximo";
        $consulta_parametrizada = $this->conexion->prepare($consulta_sql);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
    }
    public function KMsEstimadosParaMantinimiento(){

        $consulta_sql = "SELECT matricula AS 'Vehiculo', kilometros,
                                1000 - kilometros AS 'kilometros_mantenimiento'
                        FROM VEHICULO v 
                        INNER JOIN ENTREGA e
                        ON v.id_vehiculo = e.id_vehiculo
                        WHERE kilometros - 1000
                        GROUP BY kilometros, v.id_vehiculo";
        $consulta_parametrizada = $this->conexion->prepare($consulta_sql);
        $consulta_parametrizada->execute();
        //fetch es para devolver sólo una fila, fetchAall es para devolver varias
        return $consulta_parametrizada->fetchAll(PDO::FETCH_ASSOC);
    }
    public function CiudadConMasEntregas(){

        $consulta_sql = "SELECT COUNT(id),localidad
                        FROM ENTREGA
                        GROUP BY localidad
                        ORDER BY COUNT(id) DESC
                        LIMIT 1";
        $consulta_parametrizada = $this->conexion->prepare($consulta_sql);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
    }
    public function CosteXConductor(){

        $consulta_sql = "SELECT DISTINCT nombre, kilometros * 2 AS 'Coste'
                        FROM ENTREGA e
                        INNER JOIN CONDUCTOR c
                        ON c.id_conductor = e.id_conductor
                        GROUP BY c.id_conductor, kilometros";
        $consulta_parametrizada = $this->conexion->prepare($consulta_sql);
        $consulta_parametrizada->execute();
        //fetch es para devolver sólo una fila, fetchAall es para devolver varias
        return $consulta_parametrizada->fetchAll(PDO::FETCH_ASSOC);
    }
    public function VehiculosEnRuta(){

        $consulta_sql = "SELECT matricula AS 'Vehiculos en ruta',
                        coordenada_x, coordenada_y
                        FROM ENTREGA e
                        INNER JOIN VEHICULO v
                        ON v.id_vehiculo = e.id_vehiculo
                        WHERE tiempo_real IS NULL";
        $consulta_parametrizada = $this->conexion->prepare($consulta_sql);
        $consulta_parametrizada->execute();
        //fetch es para devolver sólo una fila, fetchAall es para devolver varias
        return $consulta_parametrizada->fetchAll(PDO::FETCH_ASSOC);
    }
    public function InsertarDatosFlotaVehiculos($id,$tipo,$matricula,$alarma_revision,$coordenada_x,$coordenada_y){
        $insercion = "INSERT INTO VEHICULO(id_vehiculo,tipo,matricula,alarma_revision,coordenada_x,coordenada_y)
                      VALUES(:id_vehiculo,:tipo,:matricula,:alarma_revision,:coordenada_x,:coordenada_y)";
        $insercion_parametrizada = $this->conexion->prepare($insercion);
        $insercion_parametrizada->bindParam(':id_vehiculo',$id);
        $insercion_parametrizada->bindParam(':tipo',$tipo);
        $insercion_parametrizada->bindParam(':matricula',$matricula);
        $insercion_parametrizada->bindParam(':alarma_revision',$alarma_revision);
        $insercion_parametrizada->bindParam(':coordenada_x',$coordenada_x);
        $insercion_parametrizada->bindParam(':coordenada_y',$coordenada_y);

    $resultado = $insercion_parametrizada->execute();
    if($resultado){
        echo "Inserción realizada con éxito <br>";
    } else {
        echo "Error al realizar la inserción <br>";
    }

    }
    public function InsertarDatosFlotaConductores($id,$nombre,$telefono){
        $insercion = "INSERT INTO CONDUCTOR(id_conductor,nombre,telefono)
                      VALUES(:id_conductor,:nombre,:telefono)";
        $insercion_parametrizada = $this->conexion->prepare($insercion);

        $insercion_parametrizada->bindParam(':id_conductor',$id);
        $insercion_parametrizada->bindParam(':nombre',$nombre);
        $insercion_parametrizada->bindParam(':telefono',$telefono);

    $resultado = $insercion_parametrizada->execute();

    if($resultado){
        echo "Inserción realizada con éxito <br>";
    } else {
        echo "Error al realizar la inserción <br>";
    }
    }
}


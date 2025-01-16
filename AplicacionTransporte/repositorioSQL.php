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
    public function MostrarAviones(){
        $consulta_todos_aviones = "
        SELECT v.nombre ,a.*
        FROM AVION a
        INNER JOIN VEHICULO v 
        ON v.identificador = a.identificador
        ";
        $consulta_final = $this->conexion->prepare($consulta_todos_aviones);
        $consulta_final->execute();
        return $consulta_final->fetchAll(PDO::FETCH_ASSOC);
    }
    public function MostrarCamiones(){
        $consulta = "
        SELECT v.identificador AS 'id', v.nombre AS 'nombre',c.tipo_cabina AS 'tipo de cabina', v.capacidad_carga AS 'capacidad de carga'
        FROM CAMION c
        INNER JOIN VEHICULO v
        ON c.vehiculo_identificador = v.identificador";
        $consulta_final = $this->conexion->prepare($consulta);
        $consulta_final->execute();
        return $consulta_final->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertar_avion($id,$altura_maxima,$velocidad_maxima,$tipo_ala,$autonomia){
        $insercion = "
        INSERT INTO AVION(identificador,altura_maxima,velocidad_maxima,tipo_ala,autonomia_vuelo)
        VALUES(:id,:altura_maxima,:velocidad_maxima,:tipo_ala,:autonomia)";
    
        $insercion_parametrizada = $this->conexion->prepare($insercion);
        
        $insercion_parametrizada->bindParam(':id',$id);
        $insercion_parametrizada->bindParam(':altura_maxima',$altura_maxima);
        $insercion_parametrizada->bindParam(':velocidad_maxima',$velocidad_maxima);
        $insercion_parametrizada->bindParam(':tipo_ala',$tipo_ala);
        $insercion_parametrizada->bindParam(':autonomia',$autonomia);
    
        $resultado = $insercion_parametrizada->execute();
    
        if($resultado){
            echo "Inserción realizada con éxito en AVION<br>";
        } else {
        echo "Error al realizar la inserción en AVION<br>";
        }
    }
    public function insertar_barco($id,$longitud,$tipo_propulsion,$calado_maximo){
        $insercion = "
        INSERT INTO BARCO(identificador,longitud,tipo_propulsion,calado_maximo)
        VALUES(:id,:longitud,:tipo_propulsion,:calado_maximo)";
    
        $insercion_parametrizada = $this->conexion->prepare($insercion);
        
        $insercion_parametrizada->bindParam(':id',$id);
        $insercion_parametrizada->bindParam(':longitud',$longitud);
        $insercion_parametrizada->bindParam(':tipo_propulsion',$tipo_propulsion);
        $insercion_parametrizada->bindParam(':calado_maximo',$calado_maximo);
    
        $resultado = $insercion_parametrizada->execute();
    
        if($resultado){
            echo "Inserción realizada con éxito en BARCO<br>";
        } else {
        echo "Error al realizar la inserción en BARCO<br>";
        }
    }
    public function insertar_vehiculo($id,$nombre,$codigo_modelo,$capacidad_carga,$activo){
        $insercion = "
        INSERT INTO VEHICULO(identificador,nombre,codigo_modelo,capacidad_carga,activo)
        VALUES(:id,:nombre,:codigo_modelo,:capacidad_carga,:activo)";
    
        $insercion_parametrizada = $this->conexion->prepare($insercion);
        
        $insercion_parametrizada->bindParam(':id',$id);
        $insercion_parametrizada->bindParam(':nombre',$nombre);
        $insercion_parametrizada->bindParam(':codigo_modelo',$codigo_modelo);
        $insercion_parametrizada->bindParam(':capacidad_carga',var: $capacidad_carga);
        $insercion_parametrizada->bindParam(':activo',$activo);

        $resultado = $insercion_parametrizada->execute();
    
        if($resultado){
            echo "Inserción realizada con éxito en VEHICULO<br>";
        } else {
        echo "Error al realizar la inserción en VEHICULO<br>";
        }
    }
    public function obtener_n_aviones(){
        $consulta = "
        SELECT COUNT(*) AS 'n_aviones'
        FROM avion";
        $consulta_final = $this->conexion->prepare($consulta);
        $consulta_final->execute();
        return $consulta_final->fetch(PDO::FETCH_ASSOC);
    }
    public function obtener_n_barcos(){
        $consulta = "
        SELECT COUNT(*) AS 'n_barcos'
        FROM barco";
        $consulta_final = $this->conexion->prepare($consulta);
        $consulta_final->execute();
        return $consulta_final->fetch(PDO::FETCH_ASSOC);
    } public function obtener_n_vehiculos(){
        $consulta = "
        SELECT COUNT(*) AS 'n_vehiculos'
        FROM vehiculo";
        $consulta_final = $this->conexion->prepare($consulta);
        $consulta_final->execute();
        return $consulta_final->fetch(PDO::FETCH_ASSOC);
    }
    public function Buscar_camion_x_nombre($nombre){
        $consulta = "
        SELECT v.nombre AS 'nombre', ca.longitud AS 'longitud', ca.tipo_cabina AS 'tipo de cabina'
        FROM CAMION ca
        INNER JOIN CONDUCTOR co
        INNER JOIN VEHICULO v
        ON v.identificador = ca.vehiculo_identificador
        AND ca.camion_id = co.camion_id
        WHERE co.nombre = :nombre";

        $consulta_parametrizada = $this->conexion->prepare($consulta);
        $consulta_parametrizada->bindParam(':nombre',$nombre);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetchAll(PDO::FETCH_ASSOC);
    }
    public function conductores_camiones(){
        $consulta = "
        SELECT v.nombre AS 'nombre camion', co.nombre AS 'nombre conductor', co.telefono AS 'telefono', co.direccion AS 'direccion'
        FROM CAMION ca
        INNER JOIN CONDUCTOR co
        INNER JOIN VEHICULO v
        ON v.identificador = ca.vehiculo_identificador
        AND ca.camion_id = co.camion_id";

        $consulta_parametrizada = $this->conexion->prepare($consulta);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetchAll(PDO::FETCH_ASSOC);
    }
    public function conseguir_user_pass($usuario){
        $consulta = "
        SELECT *
        FROM ADMINISTRADOR
        WHERE id_administrador = :usuario";

        $consulta_parametrizada = $this->conexion->prepare($consulta);
        $consulta_parametrizada->bindParam(':usuario',$usuario);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
    }
    public function rebajar_precio_mantenimiento($id_vehiculo){
        $actualizacion = "
        UPDATE MANTENIMIENTO_VEHICULO
        SET costo = costo * 0.9
        WHERE vehiculo_identificador = :id_vehiculo";

        $consulta_parametrizada = $this->conexion->prepare($actualizacion);
        $consulta_parametrizada->bindParam(':id_vehiculo',$id_vehiculo);
        $consulta_parametrizada->execute();
        
        if($consulta_parametrizada){
            echo "Actualizado correctamente el vehículo con ID ".$id_vehiculo;
        } else {
            echo "Error en la actualización";
        }
    }
    public function buscar_rutas_de_camion($camion_id){
        $consulta = "
        SELECT c.camion_id AS 'camion_id', v.nombre AS 'nombre', origen, destino, distancia_km, fecha, costo
        FROM RUTA r
        INNER JOIN CAMION_RUTA cr
        ON r.ruta_id = cr.ruta_id
        INNER JOIN CAMION c 
        ON c.camion_id = cr.camion_id
        INNER JOIN VEHICULO v
        ON v.identificador = c.vehiculo_identificador
        WHERE c.camion_id = :camion_id";
        $consulta_parametrizada = $this->conexion->prepare($consulta);
        $consulta_parametrizada->bindParam(':camion_id',$camion_id);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetchAll(PDO::FETCH_ASSOC);
    }
}

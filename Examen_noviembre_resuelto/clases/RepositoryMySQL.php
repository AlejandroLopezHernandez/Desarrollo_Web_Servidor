<?php
class RepositoryMySQL
{
    private $conn;

    public function __construct($host, $dbname, $user, $pass)
    {
        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

        try {
            $this->conn = new PDO($dsn, $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }

    // 1.-
    public function getVehiculosDisponibles()
    {
        $stmt = $this->conn->prepare("
        SELECT COUNT(DISTINCT id_vehiculo) AS disponibles 
        FROM ENTREGA e
        WHERE  tiempo_real IS NULL");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['disponibles'];
    }

    public function getVehiculosNoDisponibles()
    {
        $stmt = $this->conn->prepare("
            SELECT COUNT(*) AS no_disponibles 
            FROM VEHICULO 
            WHERE id_vehiculo IN (SELECT id_vehiculo FROM ENTREGA WHERE tiempo_real IS NULL)
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['no_disponibles'];
    }

    public function getEntregasEnProceso()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS en_proceso FROM ENTREGA WHERE tiempo_real IS NULL");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['en_proceso'];
    }

    public function getTiemposEntregaMedio()
    {
        $stmt = $this->conn->prepare("
            SELECT 
                AVG(tiempo_real) AS promedio_real                
            FROM ENTREGA 
            WHERE tiempo_real IS NOT NULL
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['promedio_real'];
    }

    public function getTiemposMaximoMedio()
    {
        $stmt = $this->conn->prepare("
            SELECT 
                AVG(tiempo_maximo) AS promedio_maximo                
            FROM ENTREGA 
            WHERE tiempo_maximo IS NOT NULL
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['promedio_maximo'];
    }

    public function getCiudadConMasEntregas()
    {
        $stmt = $this->conn->prepare("
            SELECT localidad, COUNT(*) AS total_entregas
            FROM ENTREGA
            GROUP BY localidad
            ORDER BY total_entregas DESC
            LIMIT 1
        ");
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ? $resultado['localidad'] : null;
    }

    public function getKmHastaMantenimiento()
    {

        // Consulta para obtener los datos de kilómetros y vehículos
        $sql = "     SELECT         v.id_vehiculo,         v.matricula, 
        SUM(e.kilometros) AS km_recorridos,
        1000 - SUM(e.kilometros)  AS km_restantes
    FROM 
        VEHICULO v
    LEFT JOIN 
        ENTREGA e ON v.id_vehiculo = e.id_vehiculo
    GROUP BY 
        v.id_vehiculo, v.matricula
    ORDER BY 
        v.id_vehiculo; ";

        $stmt = $this->conn->query($sql);
        return $stmt;
    }
    public function obtenerCostePorConductor()
    {
        $query = "
            SELECT 
                nombre, 
                SUM(kilometros) * 2 AS coste
            FROM 
                ENTREGA e,CONDUCTOR c
            where e.id_conductor=c.id_conductor
            GROUP BY 1 ";


        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Devolver los resultados como un array asociativo


        return     $resultados;        // Devolver los resultados como un array asociativo
        ;
    }
    public function getDistanciaTotal()
    {
        $stmt = $this->conn->prepare("
        SELECT SUM(kilometros) AS distancia_total 
        FROM ENTREGA 
        WHERE Tiempo_REAL IS NOT NULL
    ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['distancia_total'];
    }


    // 2.
    public function obtenerCoordenadasVehiculos()
    {
        $stmt = $this->conn->prepare("
            SELECT matricula, coordenada_x, coordenada_y 
            FROM VEHICULO v,ENTREGA e
            WHERE v.id_vehiculo=e.id_vehiculo
            AND tiempo_real is NULL
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //3.-
    public function insertarConductor($id, $nombre, $telefono)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO CONDUCTOR (id_conductor, nombre, telefono) 
            VALUES (:id, :nombre, :telefono)
            
        ");
        $stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':telefono' => $telefono,
        ]);
    }

    public function insertarVehiculo($id, $matricula, $tipo, $coordenada_x, $coordenada_y, $alarma)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO VEHICULO (id_vehiculo, matricula, tipo, coordenada_x, coordenada_y, alarma_revision) 
            VALUES (:id, :matricula, :tipo, :coordenada_x, :coordenada_y, :alarma)
        ");
        $stmt->execute([
            ':id' => $id,
            ':matricula' => $matricula,
            ':tipo' => $tipo,
            ':coordenada_x' => $coordenada_x,
            ':coordenada_y' => $coordenada_y,
            ':alarma' => $alarma,
        ]);
    }

    //4.
    public function autenticarUsuario($usuario, $password)
    {
        // Preparar la consulta para obtener el usuario por nombre
        $stmt = $this->conn->prepare("SELECT * FROM ADMINISTRADOR WHERE id_admin = :usuario");
        $stmt->execute([':usuario' => $usuario]);
        $usuarioDB = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y si la contraseña es correcta
        if ($usuarioDB && password_verify($password, $usuarioDB['password'])) {
            return true; // Autenticación exitosa
        }

        return false; // Usuario o contraseña incorrectos
    }

    //5.
    public function registrarLog($idAdmin, $fechaSubida, $numVehiculos, $numConductores)
    {
        // Preparar la consulta SQL para insertar los datos en la tabla LOGS
        $stmt = $this->conn->prepare("
            INSERT INTO LOG (id_admin, fecha_subida, num_vehiculos_nuevos, num_conductores_nuevos)
            VALUES (:id_admin, NOW(), :num_vehiculos, :num_conductores)
        ");

        // Ejecutar la consulta con los valores proporcionados
        $stmt->execute([
            ':id_admin' => $idAdmin,
            //':fecha_subida' => $fechaSubida,
            ':num_vehiculos' => $numVehiculos,
            ':num_conductores' => $numConductores
        ]);
    }

    //6.- 
    public function getvehiculosRevision()
    {
        $query = "
        SELECT matricula , SUM(e.Kilometros) as total
        FROM VEHICULO v,ENTREGA e
        WHERE v.id_vehiculo=e.id_vehiculo
        group by 1
        having sum(e.kilometros)>1000
    ";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEntregasPendientesConductor($conductor)
    {
        $sql = "SELECT 
                    ENTREGA.id, 
                    VEHICULO.matricula, 
                    CONDUCTOR.nombre AS conductor, 
                    ENTREGA.localidad, 
                    ENTREGA.kilometros, 
                    ENTREGA.tiempo_maximo 
                FROM ENTREGA
                INNER JOIN VEHICULO ON ENTREGA.id_vehiculo = VEHICULO.id_vehiculo
                INNER JOIN CONDUCTOR ON ENTREGA.id_conductor = CONDUCTOR.id_conductor
                WHERE ENTREGA.tiempo_real IS NULL";

        $params = [];
        if (!empty($conductor)) {
            $sql .= " AND CONDUCTOR.id_conductor = :conductor";
            $params[':conductor'] = $conductor;
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getEntregasPendientesVehiculo($vehiculo)
    {   /** 
        $sql = "SELECT 
                    ENTREGA.id, 
                    VEHICULO.matricula, 
                    CONDUCTOR.nombre AS conductor, 
                    ENTREGA.localidad, 
                    ENTREGA.kilometros, 
                    ENTREGA.tiempo_maximo 
                FROM ENTREGA
                INNER JOIN VEHICULO ON ENTREGA.id_vehiculo = VEHICULO.id_vehiculo
                INNER JOIN CONDUCTOR ON ENTREGA.id_conductor = CONDUCTOR.id_conductor
                WHERE ENTREGA.tiempo_real IS NULL"; */

$sql = "SELECT 
e.id, 
v.matricula, 
c.nombre AS conductor, 
e.localidad, 
kilometros, 
e.tiempo_maximo 
FROM ENTREGA e, VEHICULO v, CONDUCTOR c
 where e.id_vehiculo = v.id_vehiculo
and  e.id_conductor = c.id_conductor
and e.tiempo_real IS NULL";


        $params = [];
        if (!empty($vehiculo)) {
            $sql .= " AND v.id_vehiculo = :vehiculo";
            $params[':vehiculo'] = $vehiculo;
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getVehiculo($matricula){

        $query="SELECT * FROM VEHICULO WHERE matricula=:matricula";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':matricula', $matricula, PDO::PARAM_STR);
        $stmt->execute();
   
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function incrementarTiemposEspera($localidad)
    {
        $query = "UPDATE ENTREGA 
                  SET tiempo_maximo = tiempo_maximo * 1.2 
                  WHERE localidad = :localidad
                  AND TIEMPO_REAL IS NULL";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':localidad', $localidad, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount(); // Devuelve el número de filas afectadas.
    }
    public function cerrarConexion()
    {
        $this->conn = null;
    }
}

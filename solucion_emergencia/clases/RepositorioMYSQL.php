<?php
class RepositorioMYSQL
{
    private $conn;
    public function __construct($host, $usuario, $pass, $db)
    {
        // Configura la conexión a la base de datos
        $this->conn = new PDO("mysql:host=$host;dbname=$db", $usuario, $pass);

        // Configurar el manejo de errores
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function obtenerUltimaFechaReporte($municipio)
    {
        // Este select solo puede dar un registro
        $query = "SELECT fecha_reporte FROM estado_municipios WHERE nombre_poblacion = '$municipio' ORDER BY fecha_reporte DESC LIMIT 1";
        $result = $this->conn->query($query);

        if ($result && $row = $result->fetch()) {
            return strtotime($row['fecha_reporte']);
        } else
            return null;
    }



    // Método para guardar el estado del municipio
    public function guardarEstadoMunicipio($nombre_poblacion, $personas_afectadas, $comunicaciones_cortadas, $agua, $productos_limpieza, $viveres, $medicinas, $otros)
    {
        // Primero, comprueba si el municipio ya existe
        $queryCheck = "SELECT COUNT(*) AS total FROM estado_municipios WHERE nombre_poblacion = :nombre_poblacion";
        $stmtCheck = $this->conn->prepare($queryCheck);
        $stmtCheck->bindParam(':nombre_poblacion', $nombre_poblacion);
        $stmtCheck->execute();
        $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        // Segundo si existe el municipio se actualiza no se inserta
        if ($result['total'] > 0) {
            // Si el municipio existe, actualiza el registro
            $this->actualizarEstadoMunicipio($nombre_poblacion, $personas_afectadas, $comunicaciones_cortadas, $agua, $productos_limpieza, $viveres, $medicinas, $otros);
        } else {
            // Si el municipio no existe, inserta un nuevo registro
            $this->insertarEstadoMunicipio($nombre_poblacion, $personas_afectadas, $comunicaciones_cortadas, $agua, $productos_limpieza, $viveres, $medicinas, $otros);
        }
    }

    // Método para insertar un nuevo estado del municipio
    private function insertarEstadoMunicipio($nombre_poblacion, $personas_afectadas, $comunicaciones_cortadas, $agua, $productos_limpieza, $viveres, $medicinas, $otros)
    {
        $queryInsert = "INSERT INTO estado_municipios (nombre_poblacion, personas_afectadas, comunicaciones_cortadas, agua, productos_limpieza, viveres, medicinas, otros)
                        VALUES (:nombre_poblacion, :personas_afectadas, :comunicaciones_cortadas, :agua, :productos_limpieza, :viveres, :medicinas, :otros)";

        $stmtInsert = $this->conn->prepare($queryInsert);

        // Vincular parámetros
        $stmtInsert->bindParam(':nombre_poblacion', $nombre_poblacion);
        $stmtInsert->bindParam(':personas_afectadas', $personas_afectadas);
        $stmtInsert->bindParam(':comunicaciones_cortadas', $comunicaciones_cortadas);
        $stmtInsert->bindParam(':agua', $agua);
        $stmtInsert->bindParam(':productos_limpieza', $productos_limpieza);
        $stmtInsert->bindParam(':viveres', $viveres);
        $stmtInsert->bindParam(':medicinas', $medicinas);
        $stmtInsert->bindParam(':otros', $otros);

        // Ejecutar la consulta de inserción
        $stmtInsert->execute();
    }

    // Método para actualizar el estado del municipio
    private function actualizarEstadoMunicipio($nombre_poblacion, $personas_afectadas, $comunicaciones_cortadas, $agua, $productos_limpieza, $viveres, $medicinas, $otros)
    {
        $queryUpdate = "UPDATE estado_municipios SET
                            personas_afectadas = :personas_afectadas,
                            comunicaciones_cortadas = :comunicaciones_cortadas,
                            agua = :agua,
                            productos_limpieza = :productos_limpieza,
                            viveres = :viveres,
                            medicinas = :medicinas,
                            otros = :otros
                        WHERE nombre_poblacion = :nombre_poblacion";

        $stmtUpdate = $this->conn->prepare($queryUpdate);

        // Vincular parámetros
        $stmtUpdate->bindParam(':nombre_poblacion', $nombre_poblacion);
        $stmtUpdate->bindParam(':personas_afectadas', $personas_afectadas);
        $stmtUpdate->bindParam(':comunicaciones_cortadas', $comunicaciones_cortadas);
        $stmtUpdate->bindParam(':agua', $agua);
        $stmtUpdate->bindParam(':productos_limpieza', $productos_limpieza);
        $stmtUpdate->bindParam(':viveres', $viveres);
        $stmtUpdate->bindParam(':medicinas', $medicinas);
        $stmtUpdate->bindParam(':otros', $otros);

        // Ejecutar la consulta de actualización
        $stmtUpdate->execute();
    }






    public function obtenerMunicipiosConMasAfectados()
    {
       
        
        $query = "SELECT * FROM estado_municipios ORDER BY personas_afectadas DESC ";
        $result = $this->conn->query($query);

        $municipios = [];
        if ($result) {
            // Mientras el cursor avance y devuelva una fila
            while ($row = $result->fetch()) {
                
                $municipios[] = [
                    'nombre_poblacion' => $row['nombre_poblacion'],
                    'personas_afectadas' => (int) $row['personas_afectadas'],
                    'comunicaciones_cortadas' => $row['comunicaciones_cortadas'],
                    'agua'=> $row['agua'],
                    'productos_limpieza'=> $row['productos_limpieza'],
                    'viveres'=> $row['viveres'],
                    'medicinas'=> $row['medicinas'],
                    'otros'=> $row['otros'],
                
                    'fecha_reporte'=> $row['fecha_reporte']
                ];
            }
        }
        // Devuelve un array asociativo de información de municipios
        return $municipios;
    }

    public function obtenerNumeroTotalfectados(): int
    {
        $query = "SELECT SUM(personas_afectadas) as suma FROM estado_municipios  ";
        $result = $this->conn->query($query);

        // Verificar si la consulta se ejecutó correctamente
        if ($result !== false) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return (int)$row['suma']; // Retorna la suma como un entero
        }

        // En caso de que la consulta falle, devolver 0 o lanzar una excepción
        return 0;
    }
    public function cerrarConexion()
    {
        $conn = null;
    }
}

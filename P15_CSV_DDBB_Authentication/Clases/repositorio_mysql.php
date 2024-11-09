<?php
/* RESUMEN
+ __construct(host : String, usuario : String, pass : String, db : String) + 
obtenerUltimaFechaReporte(municipio : String) : int  
+ guardarEstadoMunicipio(nombre_poblacion : String, personas_afectadas : int, 
comunicaciones_cortadas : int, agua : int, productos_limpieza : int, viveres : int, 
medicinas : int, otros : String)  
- insertarEstadoMunicipio(nombre_poblacion : String, personas_afectadas : int, 
comunicaciones_cortadas : int, agua : int, productos_limpieza : int, viveres : int, 
medicinas : int, otros : String)  
- actualizarEstadoMunicipio(nombre_poblacion : String, personas_afectadas : int, 
comunicaciones_cortadas : int, agua : int, productos_limpieza : int, viveres : int, 
medicinas : int, otros : String)  
+ obtenerMunicipiosConMasAfectados() : Array  
+ obtenerNumeroTotalfectados() : int 
 + cerrarConexion()
*/
class RepositorioMYSQL
{
    private $conn;
    public function __construct($host, $db, $usuario, $pass)
    {
        $this->conn = new PDO(
            'mysql:host='. $host .';dbname='.$db,$usuario,$pass
        );
        $this->conn->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }
    public function obtenerUltimaFechaReporte($municipio) {}
    // Método para insertar un nuevo estado del municipio 
    private function insertarEstadoMunicipio(
        $nombre_poblacion,
        $personas_afectadas,
        $comunicaciones_cortadas,
        $agua,
        $productos_limpieza,
        $viveres,
        $medicinas,
        $otros
    ) {
        $queryInsert = "INSERT INTO estado_municipios 
        (nombre_poblacion, personas_afectadas, comunicaciones_cortadas, 
        agua, productos_limpieza, viveres, medicinas, otros) 
                                VALUES (:nombre_poblacion, 
        :personas_afectadas, :comunicaciones_cortadas, :agua, 
        :productos_limpieza, :viveres, :medicinas, :otros)";

        $stmtInsert = $this->conn->prepare($queryInsert);

        // Vincular parámetros 
        $stmtInsert->bindParam(
            ':nombre_poblacion',
            $nombre_poblacion
        );
        $stmtInsert->bindParam(
            ':personas_afectadas',
            $personas_afectadas
        );
        $stmtInsert->bindParam(
            ':comunicaciones_cortadas',
            $comunicaciones_cortadas
        );
        $stmtInsert->bindParam(':agua', $agua);
        $stmtInsert->bindParam(
            ':productos_limpieza',
            $productos_limpieza
        );
        $stmtInsert->bindParam(':viveres', $viveres);
        $stmtInsert->bindParam(':medicinas', $medicinas);
        $stmtInsert->bindParam(':otros', $otros);

        // Ejecutar la consulta de inserción 
        $stmtInsert->execute();
    }
    // Método para actualizar el estado del municipio 
    private function
    actualizarEstadoMunicipio(
        $nombre_poblacion,
        $personas_afectadas,
        $comunicaciones_cortadas,
        $agua,
        $productos_limpieza,
        $viveres,
        $medicinas,
        $otros
    ) {
        $queryUpdate = "UPDATE estado_municipios SET 
                                    personas_afectadas = 
        :personas_afectadas, 
                                    comunicaciones_cortadas = 
        :comunicaciones_cortadas, 
                                    agua = :agua, 
                                    productos_limpieza = 
        :productos_limpieza, 
                                    viveres = :viveres, 
                                    medicinas = :medicinas, 
                                    otros = :otros 
                                WHERE nombre_poblacion = 
        :nombre_poblacion";

        $stmtUpdate = $this->conn->prepare($queryUpdate);

        // Vincular parámetros 
        $stmtUpdate->bindParam(
            ':nombre_poblacion',
            $nombre_poblacion
        );
        $stmtUpdate->bindParam(
            ':personas_afectadas',
            $personas_afectadas
        );
        $stmtUpdate->bindParam(
            ':comunicaciones_cortadas',
            $comunicaciones_cortadas
        );
        $stmtUpdate->bindParam(':agua', $agua);
        $stmtUpdate->bindParam(
            ':productos_limpieza',
            $productos_limpieza
        );
        $stmtUpdate->bindParam(':viveres', $viveres);
        $stmtUpdate->bindParam(':medicinas', $medicinas);
        $stmtUpdate->bindParam(':otros', $otros);

        // Ejecutar la consulta de actualización 
        $stmtUpdate->execute();
    }
    public function obtenerMunicipiosConMasAfectados()
    {
        $query = "SELECT nombre_poblacion,personas_afectadas
                          FROM estado_municipios
                          ORDER BY personas_afectadas DESC
                          LIMIT 1";
        $municipios = $this->conn->query($query);

        // Devuelve un array asociativo de información de municipios 
        return $municipios;
    }

    public function obtenerNumeroTotalfectados(): int
    {
        $query = "SELECT SUM(personas_afectadas) as suma FROM 
                estado_municipios  ";
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
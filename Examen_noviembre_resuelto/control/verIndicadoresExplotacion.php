<?php
// Incluir la clase RepositoryMySQL
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';

// Configuración de conexión con la base de datos
$host = 'mysql';
$dbname = 'FLOTA';
$username = 'root';
$password = '1234';



// Crear una instancia del repositorio
$repository = new RepositoryMySQL($host, $dbname, $username, $password);
$vista= new VistaHTML();
// Obtenedmos los tiempos promedio de entrega y máximo
$promedio_real= $repository->getTiemposEntregaMedio();
$promedio_maximo=$repository->getTiemposMaximoMedio();

if ($promedio_real<=$promedio_maximo){
    $mensaje= "TIEMPO DE LLEGADA en promedio inferior al previsto";
}else{
    $mensaje= "TIEMPO DE LLEGADA en promedio superior al previsto";
}
// Hacemos una única vista por simplicidad y pasamos todos los datos juntos
$indicadores = [
    'vehiculos' =>['disponibles'=> $repository->getVehiculosDisponibles(),'no_disponibles'=>$repository->getVehiculosNoDisponibles()],
    'entregas' => ['en_proceso' => $repository->getEntregasEnProceso()],
    'tiempos'=> ['promedio_real'=> $repository->getTiemposEntregaMedio(),'promedio_maximo'=>$repository->getTiemposMaximoMedio()],
    'mensaje'=>['tiempo_promedio'=>$mensaje],
   'rendimiento' => ['distancia_total'=>$repository->getDistanciaTotal()],
   'mantenimiento'=>['datos'=>$repository->getKmHastaMantenimiento()],
   'ciudad_entregas'=>['ciudad'=>$repository->getCiudadConMasEntregas()],
   'coste_por_conductor'=>['costes'=>$repository->obtenerCostePorConductor()]];
;
// llamamos a la vista
$vista->mostrarIndicadores($indicadores);
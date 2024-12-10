<?php
class VistaHTML
{
    public static function mostrarIndicadores($indicadores)
    {
        echo <<<HTML
    <h1>Indicadores de Explotación de la Flota</h1>
    
    <h2>Disponibilidad de Flota</h2>
    <p>Vehículos disponibles: {$indicadores['vehiculos']['disponibles']}, No disponibles: {$indicadores['vehiculos']['no_disponibles']}</p>
    
    <h2>Estado de las Entregas</h2>
    <p>Entregas en proceso: {$indicadores['entregas']['en_proceso']}</p>
    
    
    <p>Promedio tiempo real: {$indicadores['tiempos']['promedio_real']} horas, Promedio tiempo máximo: {$indicadores['tiempos']['promedio_maximo']} horas</p>
    <p>{$indicadores['mensaje']['tiempo_promedio']}
    <h2>Datos derendimiento y coste</h2>
    <p>datos de mantenimiento:</p>
    HTML;
        $mantenimientos = $indicadores['mantenimiento']['datos'];
        foreach ($mantenimientos as $vehiculo) {
            echo "
           
          <p>  vehiculo {$vehiculo['matricula']} , recorridos : {$vehiculo['km_recorridos']}, quedan para mantenimiento :{$vehiculo['km_restantes']}     ";
        }

        echo "<p>Localidad con más entregas: {$indicadores['ciudad_entregas']['ciudad']} </p>";


        $costePorConductor = $indicadores['coste_por_conductor']['costes'];
        echo " <p>Coste de cada conductor </p>";
        echo "<table border=1>";
        echo " <tr> <th> Nombre</th> <th> Coste(euros)</th> </tr>";
        foreach ($costePorConductor as $conductor) {
            echo "
           
            <tr>
                <td>{$conductor['nombre']}</td>
                <td>{$conductor['coste']}</td>
            </tr>";
        }
        echo "</table>";
    }





    public function generarCuadricula(array $vehiculos, int $gridSize = 10)
{
    // Generar la salida HTML directamente
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Posición de Vehículos en Ruta</title>
    </head>
    <body>
    <h2>Posición de Vehículos en Ruta</h2>
    <table border='1'>";

    // Generar filas y columnas directamente
    for ($row = 0; $row < $gridSize; $row++) {
        echo "<tr>";
        for ($col = 0; $col < $gridSize; $col++) {
            // Comprobar si hay un vehículo en esta posición
            $vehiculoEnPosicion = null;
            foreach ($vehiculos as $vehiculo) {
                if ($vehiculo['coordenada_x'] == $col && $vehiculo['coordenada_y'] == $row) {
                    $vehiculoEnPosicion = $vehiculo['matricula'];
                    break; // No es necesario seguir buscando
                }
            }

            // Generar el TD
            echo "<td>";
            echo $vehiculoEnPosicion ? $vehiculoEnPosicion : "--";
            echo "</td>";
        }
        echo "</tr>";
    }

    echo "</table>
    </body>
    </html>";
}

public function generarCuadricula2(array $vehiculos, int $gridSize = 10)
{
    // Generar la salida HTML directamente
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Posición de Vehículos en Ruta</title>
    </head>
    <body>
    <h2>Posición de Vehículos en Ruta</h2>
    <table border='1'>";

    // Generar filas y columnas directamente
    for ($row = 0; $row < $gridSize; $row++) {
        echo "<tr>";
        for ($col = 0; $col < $gridSize; $col++) {
            // Comprobar si hay un vehículo en esta posición
            // Recorremos el array cada vez que hay que poner un <td>
            $vehiculoEnPosicion = null;
            foreach ($vehiculos as $vehiculo) {
                if ($vehiculo['coordenada_x'] == $col && $vehiculo['coordenada_y'] == $row) {
                    $vehiculoEnPosicion = $vehiculo['matricula'];
                    break; // No es necesario seguir buscando
                }
            }

            // Generar el TD
            echo "<td>";
            if ($vehiculoEnPosicion) {
                // Enlace con la matrícula como parámetro
                echo "<a href='verVehiculo.php?matricula=" . urlencode($vehiculoEnPosicion) . "'>" . htmlspecialchars($vehiculoEnPosicion) . "</a>";
            } else {
                echo "--";
            }
            echo "</td>";
        }
        echo "</tr>";
    }

    echo "</table>
    </body>
    </html>";
}

    public function mostrarMensaje($mensaje)
    {

        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Posición de Vehículos en Ruta</title>
        </head>
        <body>
        <h2>{$mensaje}</h2>
        ";
        echo "</body> </html>";
    }

    public function mostrarVehiculosRevision($vehiculos)
    {
        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Posición de Vehículos en Ruta</title>
        </head><body>";

        foreach ($vehiculos as $vehiculo) {
            echo '<p> Matricula de vehículo :' . $vehiculo['matricula'];
        }
        echo "</body> </html>";
    }
    public function mostrarEntregasPendientes($entregas)
    {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<thead>";
        echo "<tr>
                <th>ID</th>
                <th>Matrícula</th>
                <th>Conductor</th>
                <th>Localidad</th>
                <th>Kilómetros</th>
                <th>Tiempo Máximo</th>
              </tr>";
        echo "</thead><tbody>";

        if (empty($entregas)) {
            echo "<tr><td colspan='6'>No se encontraron entregas pendientes.</td></tr>";
        } else {
            foreach ($entregas as $entrega) {
                echo "<tr>
                        <td>{$entrega['id']}</td>
                        <td>{$entrega['matricula']}</td>
                        <td>{$entrega['conductor']}</td>
                        <td>{$entrega['localidad']}</td>
                        <td>{$entrega['kilometros']}</td>
                        <td>{$entrega['tiempo_maximo']} min</td>
                      </tr>";
            }
        }

        echo "</tbody></table>";
        echo "<a href='../control/formularioEntregas.php'> Volver a busqueda</a>";
    }

    public function mostrarMensajeSalidaTiemposEspera($localidad)
    {

        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Incremento de tiempo máxmio en entregas</title>
        </head><body>";


        echo '<p> Las entregas pendientes de :' . $localidad . " han sido incrementadas en un 20%";
        echo "</body> </html>";
    }
    public function mostrarVehiculo($vehiculo){
        echo "<p> datos del vehiculo";
        foreach ($vehiculo as $v){}
            echo "<p>".$v["matricula"];
            echo  "<p>".$v["tipo"];
            echo  "<p>".$v["alarma_revision"];
    }
    
}

<?php
class VistaHTMLFlota{
    public function __construct(){}

    //Como la consulta sólo da un resultado, no necesitamos un buble for each para recorrerla
    public function MostrarVehiculosDisponibles($vehiculo){
        echo '<strong>Vehículos disponibles: </strong>';
        echo "<span>{$vehiculo['Disponibles']}</span>";
        echo "<br>";
        }
    
    public function MostrarVehiculosNoDisponibles($vehiculo){
        echo "<strong>Vehículos no disponibles: </strong>";
        echo "<span>{$vehiculo['No disponibles']}</span>";
        echo "<br>";
        
    }
    public function MostrarEntregasPendientes($entregas){
        echo "<strong>Entregas pedientes: </strong>";
        echo "<span>{$entregas['Entregas pendientes']}</span>"; 
        echo "<br>";

    }
    public function MostrarTiemposEntregaReal($tiempos){
        echo "<strong>Tiempo promedio de entrega real: </strong>";
        echo "<span>{$tiempos['Tiempo promedio entrega real']}</span>"; 
        echo "<br>";

    }
    public function MostrarTiemposEntregaMaximo($tiempos){
        echo "<strong>Tiempo promedio de entrega máximo: </strong>";
        echo "<span>{$tiempos['Tiempo promedio entrega maximo']}</span>"; 
        echo "<br>";

    }
    public function MostrarEntregasATiempo($tiempos){
        echo "<strong>Entregas a tiempo: </strong>";
        echo "<span>{$tiempos['Entregas a tiempo']}</span>"; 
        echo "<br>";

    }
    public function MostrarKMsParaMantenimiento($vehiculos){
        echo "<strong>KMs pendientes para mantenimiento: </strong>";
        echo '<table border="2" >'; 
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Kilometros Recorridos</th>";
        echo "<th>Kilometros para prox. mantenimiento</th>";
        echo "</tr>";
        foreach ($vehiculos as $conductor){
            echo "<tr>
                 <td>{$conductor['Vehiculo']}</td>
                 <td>{$conductor['kilometros']}</td>
                 <td>{$conductor['kilometros_mantenimiento']}</td>
                 </tr>";
        }
        echo "</table>";
    }
    public function MostrarCiudadMaxEntregas($ciudad){
        echo "<strong>Ciudad con más entregas: </strong>";
        echo "<span>{$ciudad['localidad']}</span>"; 
        echo "<br>";

    }
    public function MostrarCosteXConductor($costes){
        echo "<strong>Coste por conductor: </strong>";
        echo '<table border="2" >'; 
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Coste</th>";
        echo "</tr>";
        foreach ($costes as $conductor){
            echo "<tr>
                 <td>{$conductor['nombre']}</td>
                 <td>{$conductor['Coste']}</td>
                 </tr>";
        }
        echo "</table>";
    }
    public function ImprimirMatriz($datos){
        echo "<table border=5 cellpadding='10'";
        for($i = 0; $i<10; $i++){
            echo "<tr>";
            for($j = 0; $j<10; $j++){
                $vehiculo_en_posicion = null;
                foreach ($datos as $vehiculo){
                    if($vehiculo['coordenada_x'] == $j && $vehiculo['coordenada_y'] == $i){
                        $vehiculo_en_posicion = $vehiculo['Vehiculos en ruta'];
                        break;
                    }
                }
                echo "<td>";
                    if ($vehiculo_en_posicion){
                        echo $vehiculo_en_posicion;
                    } else {
                        echo "--";
                    }
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    
}


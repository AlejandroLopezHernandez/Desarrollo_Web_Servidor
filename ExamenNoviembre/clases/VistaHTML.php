<?php

class VistaFlota{
    public function __construct(){}
    public function VehiculosNoDisponibles($vehiculos){
        echo "<strong> Vehículos no disponibles:</strong>";
        echo "<span>{$vehiculos['No disponibles']}</span>";
        echo "<br>";
    }
    public function VehiculosDisponibles($vehiculos){
        echo '<strong> Vehículos disponibles:</strong>';
        echo "<span>{$vehiculos['Disponibles']}</span>";
        echo '<br>';
    }
    public function VehiculosPendientes($vehiculos){
        echo "<strong> Vehículos pendientes:</strong>";
        echo "<span>{$vehiculos['Pendientes']}</span>";
        echo "<br>";
    }
    public function TiempoMaximo($tiempo){
        echo "<strong>Tiempo máximo de entrega:</strong>";
        echo "<span>{$tiempo['Promedio de tiempo maximo']}</span>";
        echo "<br>";
    }
    public function TiempoReal($tiempo){
        echo "<strong> Tiempo real de entrega:</strong>";
        echo "<span>{$tiempo['Promedio de tiempo real']}</span>";
        echo "<br>";
    }
    public function CiudadMasEntregas($ciudad_mas_entregas){
        echo "<strong> Ciudad con más entregas:</strong>";
        echo "<span>{$ciudad_mas_entregas['localidad']}</span>";
        echo "<br>";
    }
    public function DatosMantenimiento($vehiculos){
        echo ' 
            <strong>Coste de cada conductor</strong> 
            <table border="2"> 
                <thead> 
                    <tr> 
                        <th>Vehiculo</th> 
                        <th>KMs recorridos</th>
                        <th>KMs pendientes para mantenimiento</th>  
                    </tr> 
                </thead> 
                <tbody>';
            foreach($vehiculos as $vehiculo){
                echo "<tr> 
                    <td>{$vehiculo['matricula']}</td> 
                    <td>{$vehiculo['KMs recorridos']}</td> 
                    <td>{$vehiculo['KMs para mantenimiento']}</td>                              
                  </tr>";
            }
            echo ' 
            </table>';
    }
    public function CosteConductores($conductores){
        echo ' 
            <strong>Coste de cada conductor</strong> 
            <table border="2"> 
                <thead> 
                    <tr> 
                        <th>Nombre</th> 
                        <th>Coste en euros</th>  
                    </tr> 
                </thead> 
                <tbody>';
            foreach($conductores as $conductor){
                echo "<tr> 
                    <td>{$conductor['nombre']}</td> 
                    <td>{$conductor['Coste']}</td>                              
                  </tr>";
            }
            echo ' 
            </table>';
    }
    public function imprimir_matriz($datos){
        echo "<h2>Posición de vehículos en ruta</h2>";
        echo "<table border=5 cellpadding='10'>";
        for($i = 0; $i < 10; $i ++){
            echo "<tr>";
        for ($j = 0; $j < 10; $j ++){
            $vehiculo_posicion = null;
            foreach($datos as $vehiculo){
                if($vehiculo['coordenada_x'] == $j && $vehiculo['coordenada_y'] == $i){
                    $vehiculo_posicion = $vehiculo['Vehiculos en ruta'];
                    break;
                }
            }
            echo "<td>";
            if($vehiculo_posicion){
                echo $vehiculo_posicion;
            } else {
                echo "--";
            }
            echo "</td>";
        }
        echo "</tr>";
        }
        echo "</table>";

    }
    public function vehiculos_en_revision($vehiculo){
        echo "<strong> Pasar la revisión de :</strong>";
        echo "<span>{$vehiculo['matricula']}</span>";
        echo "<br>";
    }
    public function mostrar_vehiculo($datos){
       echo '<strong>Datos del vehículo</strong> 
        <table border="2"> 
            <thead> 
                <tr> 
                    <th>ID</th> 
                    <th>Matrícula</th>  
                    <th>Conductor</th>  
                    <th>Localidad</th>  
                    <th>Kilómetros</th>  
                    <th>Tiempo Máximo</th>  
                </tr> 
            </thead> 
            <tbody>';
        foreach($datos as $vehiculo){
            echo "<tr> 
                <td>{$vehiculo['id']}</td> 
                <td>{$vehiculo['matricula']}</td>                              
                <td>{$vehiculo['nombre']}</td>   
                <td>{$vehiculo['localidad']}</td>                              
                <td>{$vehiculo['kilometros']}</td>                              
                <td>{$vehiculo['tiempo_maximo']}</td>                              
              </tr>";
        }
        echo ' 
        </table>';
    }
    public function mostrar_conductor($datos){
        echo '<strong>Datos del conductor</strong> 
        <table border="2"> 
            <thead> 
                <tr> 
                    <th>ID</th> 
                    <th>Matrícula</th>  
                    <th>Conductor</th>  
                    <th>Localidad</th>  
                    <th>Kilómetros</th>  
                    <th>Tiempo Máximo</th>  
                </tr> 
            </thead> 
            <tbody>';
        foreach($datos as $conductor){
            echo "<tr> 
                <td>{$conductor['id']}</td> 
                <td>{$conductor['matricula']}</td>                              
                <td>{$conductor['nombre']}</td>   
                <td>{$conductor['localidad']}</td>                              
                <td>{$conductor['kilometros']}</td>                              
                <td>{$conductor['tiempo_maximo']}</td>                              
              </tr>";
        }
        echo ' 
        </table>';
    }
}

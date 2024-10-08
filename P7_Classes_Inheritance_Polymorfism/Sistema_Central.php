<?php 
class SistemaCentral { 
private $vehiculos = []; //implementa un array asociativo    
[‘id_vehiculo’=>objetovehiculo];
    private $centralesRecarga = [];  
 
    public function agregarVehiculo(VehiculoAutonomo $vehiculo) { 
        $this->vehiculos[$vehiculo->id] = $vehiculo; 
    } 
 
    public function agregarCentralRecarga(CentralRecarga $central) { 
        $this->centralesRecarga[$central->id] = $central; 
    } 
 
    public function mostrarVehiculos() { 
    foreach ($this->vehiculos as $vehiculo) { 
        echo $vehiculo['id'];
        echo $vehiculo['coordenadas'];
        echo $vehiculo['nivelBateria'];
        } 
    } 
 
    public function encontrarCentralCercana($coordenadasVehiculo) { 
        $centralMasCercana = null; 
        $distanciaMinima = PHP_INT_MAX; 
 
        foreach ($this->centralesRecarga as $central) { 
            $distancia = $this->calcularDistancia($coordenadasVehiculo, $central->coordenadasCentral); 
            if ($distancia < $distanciaMinima) { 
                $distanciaMinima = $distancia; 
                $centralMasCercana = $coordenadasCentral; 
            } 
        } 
 
        return $centralMasCercana; 
    } 
 
    private function calcularDistancia($coordenadasA, $coordenadasB) { 
        return sqrt(pow($coordenadasB[0] - $coordenadasA[0], 2)  + pow($coordenadasB[1] - $coordenadasA[1], 2)); 
    } 
 
    public function recargarVehiculo($idVehiculo) { 
        if (isset($this->vehiculos[$idVehiculo])) { 
            $vehiculo = $this->vehiculos[$idVehiculo]; 
            $centralCercana = $this->encontrarCentralCercana($vehiculo->getCoordenadas()); 
             
                if ($centralCercana) { 
                echo "Recargando el vehículo en la central de recarga más cercana en: " . implode(",", $centralCercana) . "\n"; 
                $vehiculo->recargarBateria(); 
                } else { 
                echo "No hay centrales de recarga disponibles.\n"; 
                     } 
                    } else { 
                        echo "Vehículo no encontrado.\n"; 
                    } 
                } 
}
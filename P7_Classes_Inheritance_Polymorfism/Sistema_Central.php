<?php
require_once "VehiculoAutonomo.php";
class SistemaCentral
{
    private $vehiculos = []; //implementa un array asociativo  [‘id_vehiculo’=>objetovehiculo];
    private $centralesRecarga = [];

    public function agregarVehiculo(VehiculoAutonomo $vehiculo)
    {

        $this->vehiculos[$vehiculo->getid()] = $vehiculo;
    }

    public function agregarCentralRecarga(CentralRecarga $central)
    {
        $this->centralesRecarga[$central->getid()] = $central;
    }

    public function mostrarVehiculos()
    {
        foreach ($this->vehiculos as $vehiculo) {
            echo "ID: " . $vehiculo->getid() . "<br>";
            echo "Coordenadas: " . implode(",", $vehiculo->getCoordenadas()) . "<br>";
            echo "Nivel de batería: " . $vehiculo->getNivelBateria() . '<br>';
        }
    }

    public function encontrarCentralCercana($coordenadasVehiculo)
    {
        $centralMasCercana = null;
        $distanciaMinima = PHP_INT_MAX;

        foreach ($this->centralesRecarga as $central) {
            $distancia = $this->calcularDistancia($coordenadasVehiculo, $central->getCoordenadas());
            if ($distancia < $distanciaMinima) {
                $distanciaMinima = $distancia;
                $centralMasCercana = $central->getCoordenadas();
            }
        }
        return $centralMasCercana;
    }

    private function calcularDistancia($coordenadasA, $coordenadasB)
    {
        //sqrt es para hacer la raíz cuadrada
        //pow se usa para elevar al cuadrado
        return sqrt(pow($coordenadasB[0] - $coordenadasA[0], 2)  + pow($coordenadasB[1] - $coordenadasA[1], 2));
    }

    public function recargarVehiculo($idVehiculo)
    {
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
    public function mostrarCentrales()
    {
        foreach ($this->centralesRecarga as $central) {
            echo "ID: " . $central->getid() . "<br>";
            echo "Coordenadas: " . implode(",", $central->getCoordenadas()) . "<br>";
            echo "Puesto de recarga libre: " . $central->getpuestoRecargaLibre() . '<br>';
        }
    }
}

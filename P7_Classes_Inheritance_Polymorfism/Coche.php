<?php
// Clase para Coche, que extiende VehiculoAutonomo 
class Coche extends VehiculoAutonomo
{
    protected $supervision_conductor;
    public function mover($nuevasCoordenadas)
    {
        // Lógica de movimiento específica para el coche (por carretera) 
        echo "El coche se mueve de " . implode(",", $this->coordenadas) . " a " . implode(",", $nuevasCoordenadas) . "\n";
        $this->coordenadas = $nuevasCoordenadas;
    }
    public function mostrarTipoVehiculo()
    {
        echo "Este es un coche autónomo.\n";
    }
}

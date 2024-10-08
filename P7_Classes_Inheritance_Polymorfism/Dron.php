<?php
// Clase para Dron, que extiende VehiculoAutonomo 
class Dron extends VehiculoAutonomo { 
    protected $motores = 4;
    protected $estado; 

    public function mover($nuevasCoordenadas) { 
        // Lógica de movimiento específica para el dron (por aire) 
        echo "El dron se mueve de " . implode(",", $this->coordenadas) . " a " . implode(",", $nuevasCoordenadas) . "\n"; 
        $this->coordenadas = $nuevasCoordenadas; 
    } 
 
    public function mostrarTipoVehiculo() { 
        echo "Este es un dron.\n"; 
    } 
} 
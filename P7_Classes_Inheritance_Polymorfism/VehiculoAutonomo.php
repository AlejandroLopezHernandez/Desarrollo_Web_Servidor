<?php
// Clase base para todos los vehículos autónomos 
abstract class VehiculoAutonomo { 
    protected $id; 
    protected $coordenadas; // [x, y] array 
    protected $nivelBateria; 
 
    public function __construct($id, $coordenadas, $nivelBateria = 100) { 
        $this->id = $id;
        $this->coordenadas = $coordenadas;
        $this->nivelBateria = $nivelBateria;
    } 
    public function getCoordenadas() { 
        return $this->coordenadas;
    } 
    public function setCoordenadas($coordenadas) { 
        $this->coordenadas = $coordenadas;
    } 
    public function getNivelBateria() { 
        return $this->nivelBateria;
    } 
    public function recargarBateria() { 
        $nivelBateria ++;
    } 
 
    abstract public function mover($nuevasCoordenadas); 
 
    abstract public function mostrarTipoVehiculo(); 
} 
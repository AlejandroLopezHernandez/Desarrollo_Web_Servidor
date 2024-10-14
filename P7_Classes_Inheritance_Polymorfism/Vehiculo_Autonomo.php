<?php
// Clase base para todos los vehículos autónomos 
abstract class VehiculoAutonomo
{
    protected $id;
    protected $coordenadas; // [x, y] array 
    protected $nivelBateria;

    public function __construct($id, $coordenadas, $nivelBateria = 100)
    {
        $this->id = $id;
        $this->coordenadas = $coordenadas;
        $this->nivelBateria = $nivelBateria;
    }
    //Así se hace un método GETTER en PHP
    public function getCoordenadas()
    {
        return $this->coordenadas;
    }
    //Así se hace un método SETTER en PHP
    public function setCoordenadas($coordenadas)
    {
        $this->coordenadas = $coordenadas;
    }
    public function getNivelBateria()
    {
        return $this->nivelBateria;
    }
    public function getid()
    {
        return $this->id;
    }
    public function recargarBateria()
    {
        $this->nivelBateria++;
    }

    abstract public function mover($nuevasCoordenadas);

    abstract public function mostrarTipoVehiculo();
}

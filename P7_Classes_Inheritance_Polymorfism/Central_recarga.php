<?php

class CentralRecarga
{

    protected $id;
    protected $coordenadas;
    protected $puestoRecargaLibre;

    public function __construct($id, $coordenadas, $puestoRecargaLibre)
    {
        $this->id = $id;
        $this->coordenadas = $coordenadas; //Esto es un array[x,y]
        $this->puestoRecargaLibre = $puestoRecargaLibre;
    }
    //MUY IMPORTANTE: los SETTER y GETTER
    public function getid()
    {
        return $this->id;
    }
    public function getCoordenadas()
    {
        return $this->coordenadas;
    }
    public function getpuestoRecargaLibre()
    {
        return $this->puestoRecargaLibre;
    }
}

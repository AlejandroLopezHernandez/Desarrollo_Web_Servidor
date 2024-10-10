<?php

class CentralRecarga
{

    protected $id;
    protected $coordenadas;
    protected $puestoRecargaLibre;

    public function __construct($id, $coordenadas, $puestoRecargaLibre)
    {
        $this->id = $id;
        $this->coordenadas = $coordenadas;
        $this->puestoRecargaLibre = $puestoRecargaLibre;
    }
}

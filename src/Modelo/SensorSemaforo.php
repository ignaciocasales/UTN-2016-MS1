<?php

namespace Modelo;

class SensorSemaforo extends Sensor
{
    public function __construct($fechaAlta, $latitud, $longitud, $numeroSerie)
    {
        parent::__construct($fechaAlta, $latitud, $longitud, $numeroSerie);
    }
}
<?php

namespace Modelo;

class SensorPeaje extends Sensor
{

    public function __construct($fechaAlta, $latitud, $longitud, $numeroSerie)
    {
        parent::__construct($fechaAlta, $latitud, $longitud, $numeroSerie);
    }

}
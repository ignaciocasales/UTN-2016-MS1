<?php

namespace Modelo;

class EventoPeaje
{
    private $id = null;
    private $fechaYhora;
    private $sensorPeaje = null;

    public function __construct($fecha_hora, SensorPeaje $sensorPeaje)
    {
        $this->fechaYhora = $fecha_hora;
        $this->sensorPeaje = $sensorPeaje;
    }

    public function __destruct()
    {
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFechaYhora($fechaYhora)
    {
        $this->fechaYhora = $fechaYhora;
    }

    public function setSensorPeaje($sensor)
    {
        $this->sensorPeaje = $sensor;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFechaYhora()
    {
        return $this->fechaYhora;
    }

    public function getSensorPeaje()
    {
        return $this->sensorPeaje;
    }
}

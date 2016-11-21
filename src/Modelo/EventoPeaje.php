<?php

namespace Modelo;

class EventoPeaje
{
    private $id = null;
    private $fechaYhora;
    private $sensorPeaje = null;

    function __construct($fecha_hora, $sensorPeaje)
    {
        $this->fechaYhora = $fecha_hora;
        $this->sensorPeaje = $sensorPeaje;
    }

    function __destruct()
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
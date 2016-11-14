<?php

namespace Modelo;

class EventoPeaje
{
    private $id;
    private $fechaYhora;
    private $foto;
    private $sensorPeaje;

    function __construct($fecha_hora, $foto, $sensorPeaje)
    {
        $this->fechaYhora = $fecha_hora;
        $this->foto = $foto;
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

    public function setFoto($foto)
    {
        $this->foto = $foto;
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

    public function getFoto()
    {
        return $this->foto;
    }

    public function getSensorPeaje()
    {
        return $this->sensorPeaje;
    }

}
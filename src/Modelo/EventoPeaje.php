<?php

namespace Modelo;

class EventoPeaje
{
    private $id=null;
    private $fechaYhora;
    private $foto=null;
    private $sensorPeaje=null;

    function __construct($fecha_hora)
    {
        $this->fechaYhora = $fecha_hora;
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
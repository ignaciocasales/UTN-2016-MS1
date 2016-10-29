<?php

namespace Modelo;

class EventoPeaje
{

    private $fecha_hora;
    private $foto;
    private $m_SensorPeaje;

    function __construct($fecha_hora, $foto, $m_SensorPeaje)
    {
        $this->fecha_hora = $fecha_hora;
        $this->foto = $foto;
        $this->m_SensorPeaje = $m_SensorPeaje;
    }

    function __destruct()
    {
    }

    public function setFecha($fecha)
    {
        $this->fecha_hora = $fecha;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function setSensorPeaje($sensor)
    {
        $this->m_SensorPeaje = $sensor;
    }

    public function getFecha()
    {
        return $this->fecha_hora;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function getSensorPeaje()
    {
        return $this->m_SensorPeaje;
    }

}
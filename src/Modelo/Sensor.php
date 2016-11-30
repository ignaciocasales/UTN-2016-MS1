<?php

namespace Modelo;

class Sensor
{
    private $id;
    private $fechaAlta;
    private $latitud;
    private $longitud;
    private $numeroSerie;

    public function __construct($fechaAlta, $latitud, $longitud, $numeroSerie)
    {
        $this->fechaAlta = $fechaAlta;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->numeroSerie = $numeroSerie;
    }

    public function __destruct()
    {
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFechaAlta($fecha)
    {
        $this->fechaAlta = $fecha;
    }

    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    }

    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    }

    public function setNumeroSerie($numeroSerie)
    {
        $this->numeroSerie = $numeroSerie;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    public function getLatitud()
    {
        return $this->latitud;
    }

    public function getLongitud()
    {
        return $this->longitud;
    }

    public function getNumeroSerie()
    {
        return $this->numeroSerie;
    }
}

<?php

namespace Modelo;

class Sensor
{

    private $fecha_alta;
    private $latitud;
    private $longitud;
    private $numero_serie;

    function __construct($fecha_alta, $latitud, $longitud, $numero_serie)
    {
        $this->fecha_alta = $fecha;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->numero_serie = $numero_serie;
    }

    function __destruct()
    {
    }

    public function setFechaAlta($fecha)
    {
        $this->fecha_alta = $fecha;
    }

    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    }

    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    }

    public function setNumeroSerie($numero_serie)
    {
        $this->numero_serie = $numero_serie;
    }

    public function getFechaAlta()
    {
        return $this->fecha_alta;
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
        return $this->numero_serie;
    }

}
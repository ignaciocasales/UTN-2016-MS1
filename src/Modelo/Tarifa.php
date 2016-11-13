<?php

namespace Modelo;

class Tarifa
{
    private $fecha_desde;
    private $fecha_hasta;
    private $multa;
    private $peaje_horas_normal;
    private $peaje_horas_pico;
    private $id = 0;

    function __construct($fecha_desde, $fecha_hasta, $multa, $peaje_horas_normal, $peaje_horas_pico)
    {
        $this->fecha_desde = $fecha_desde;
        $this->fecha_hasta = $fecha_hasta;
        $this->multa = $multa;
        $this->peaje_horas_normal = $peaje_horas_normal;
        $this->peaje_horas_pico = $peaje_horas_pico;
    }

    function __destruct()
    {
    }

    public function setFechaDesde($fecha_desde)
    {
        $this->fecha_desde = $fecha_desde;
    }

    public function setFechaHasta($fecha_hasta)
    {
        $this->fecha_hasta = $fecha_hasta;
    }

    public function setMulta($multa)
    {
        $this->multa = $multa;
    }

    public function setPeajeHorasNormal($peaje_horas_normal)
    {
        $this->peaje_horas_normal = $peaje_horas_normal;
    }

    public function setPeajeHorasPico($peaje_horas_pico)
    {
        $this->peaje_horas_pico = $peaje_horas_pico;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFechaDesde()
    {
        return $this->fecha_desde;
    }

    public function getFechaHasta()
    {
        return $this->fecha_hasta;
    }

    public function getMulta()
    {
        return $this->multa;
    }

    public function getPeajeHorasNormal()
    {
        return $this->peaje_horas_normal;
    }

    public function getPeajeHorasPico()
    {
        return $this->peaje_horas_pico;
    }

    public function getId()
    {
        return $this->id;
    }

}
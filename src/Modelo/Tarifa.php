<?php

namespace Modelo;

class Tarifa
{

    private $id;
    private $fechaDesde;
    private $fechaHasta;
    private $multa;
    private $peajeHorasNormal;
    private $peajeHorasPico;

    public function __construct($fechaDesde, $fechaHasta, $multa, $peajeHorasNormal, $peajeHorasPico)
    {
        $this->fechaDesde = $fechaDesde;
        $this->fechaHasta = $fechaHasta;
        $this->multa = $multa;
        $this->peajeHorasNormal = $peajeHorasNormal;
        $this->peajeHorasPico = $peajeHorasPico;
    }

    public function __destruct()
    {
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFechaDesde($fechaDesde)
    {
        $this->fechaDesde = $fechaDesde;
    }

    public function setFechaHasta($fechaHasta)
    {
        $this->fechaHasta = $fechaHasta;
    }

    public function setMulta($multa)
    {
        $this->multa = $multa;
    }

    public function setPeajeHorasNormal($peajeHorasNormal)
    {
        $this->peajeHorasNormal = $peajeHorasNormal;
    }

    public function setPeajeHorasPico($peajeHorasPico)
    {
        $this->peajeHorasPico = $peajeHorasPico;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFechaDesde()
    {
        return $this->fechaDesde;
    }

    public function getFechaHasta()
    {
        return $this->fechaHasta;
    }

    public function getMulta()
    {
        return $this->multa;
    }

    public function getPeajeHorasNormal()
    {
        return $this->peajeHorasNormal;
    }

    public function getPeajeHorasPico()
    {
        return $this->peajeHorasPico;
    }
}

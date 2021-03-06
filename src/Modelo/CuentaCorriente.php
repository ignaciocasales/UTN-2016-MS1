<?php

namespace Modelo;

class CuentaCorriente
{
    private $id;
    private $fechaUltimaActualizacion;
    private $maximoCredito;
    private $saldo;
    private $vehiculo;

    public function __construct($fechaUltimaActualizacion, $maximoCredito, $saldo, Vehiculo $vehiculo)
    {
        $this->fechaUltimaActualizacion = $fechaUltimaActualizacion;
        $this->maximoCredito = $maximoCredito;
        $this->saldo = $saldo;
        $this->vehiculo = $vehiculo;
    }

    public function __destruct()
    {
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFechaUltimaActualizacion($fechaUltimaActualizacion)
    {
        $this->fechaUltimaActualizacion = $fechaUltimaActualizacion;
    }

    public function setMaximoCredito($credito)
    {
        $this->maximoCredito = $credito;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;
    }

    public function setVehiculo($vehiculo)
    {
        $this->vehiculo = $vehiculo;
    }

    public function getFechaUltimaActualizacion()
    {
        return $this->fechaUltimaActualizacion;
    }

    public function getMaximoCredito()
    {
        return $this->maximoCredito;
    }

    public function getSaldo()
    {
        return $this->saldo;
    }

    public function getVehiculo()
    {
        return $this->vehiculo;
    }
}

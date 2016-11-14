<?php

namespace Modelo;

class CuentaCorriente
{

    private $fechaUltimaActualizacion;
    private $maximoCredito;
    private $saldo;
    private $vehiculo;

    function __construct($fechaUltimaActualizacion, $maximoCredito, $saldo, $vehiculo)
    {
        $this->fechaUltimaActualizacion = $fechaUltimaActualizacion;
        $this->maximoCredito = $maximoCredito;
        $this->saldo = $saldo;
        $this->vehiculo = $vehiculo;
    }

    function __destruct()
    {
    }

    public function setFecha($fecha)
    {
        $this->fechaUltimaActualizacion = $fecha;
    }

    public function setMaximoCredito($mCredito)
    {
        $this->maximoCredito = $mCredito;
    }

    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;
    }

    public function setVehiculo($vehiculo)
    {
        $this->vehiculo = $vehiculo;
    }

    public function getFecha()
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
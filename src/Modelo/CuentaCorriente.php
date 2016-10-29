<?php

namespace Modelo;

class CuentaCorriente
{

    private $fecha_ultima_actualizacion;
    private $maximo_credito;
    private $saldo;
    private $m_Vehiculo;

    function __construct($fecha, $mCredito, $saldo, $vehiculo)
    {
        $this->fecha_ultima_actualizacion = $fecha;
        $this->maximo_credito = $mCredito;
        $this->saldo = $saldo;
        $this->m_Vehiculo = $vehiculo;
    }

    function __destruct()
    {
    }

    public function setFecha($fecha)
    {
        $this->fecha_ultima_actualizacion = $fecha;
    }

    public function setMaximoCredito($mCredito)
    {
        $this->maximo_credito = $mCredito;
    }

    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;
    }

    public function setVehiculo($vehiculo)
    {
        $this->m_Vehiculo = $vehiculo;
    }

    public function getFecha()
    {
        return $this->fecha_ultima_actualizacion;
    }

    public function getMaximoCredito()
    {
        return $this->maximo_credito;
    }

    public function getSaldo()
    {
        return $this->saldo;
    }

    public function getVehiculo()
    {
        return $this->m_Vehiculo;
    }

}
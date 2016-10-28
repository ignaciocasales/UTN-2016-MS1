<?php


namespace Modelo;


/**
 * @author Damian
 * @version 1.0
 * @created 22-oct-2016 05:05:17 p.m.
 */
class CuentaCte implements JsonSerializable
{

	private $fecha_ultima_actualizacion;
	private $maximo_credito;
	private $saldo;
    private $m_Vehiculo;

	function __construct($fecha,$mCredito,$saldo,$vehiculo)
	{
        $this->fecha_ultima_actualizacion = $fecha;
        $this->maximo_credito = $mCredito;
        $this->saldo = $saldo;
        $this->m_Vehiculo = $vehiculo;
	}

	function __destruct(){}
    
    public function setFecha($fecha){
        $this->fecha_ultima_actualizacion = $fecha;
    }
    public function setMaximoCredito($mCredito){
        $this->maximo_credito = $mCredito;
    }
    public function setSaldo($saldo){
        $this->saldo = $saldo;
    }
    public function setVehiculo($vehiculo){
        $this->m_Vehiculo = $vehiculo;
    }
    public function getFecha(){
        return $this->fecha_ultima_actualizacion;
    }
    public function getMaximoCredito(){
        return $this->maximo_credito;
    }
    public function getSaldo(){
        return $this->saldo;
    }
    public function getVehiculo(){
        return $this->m_Vehiculo;
    }
    
    public function jsonSerialize(){
        return [
            'fecha_ultima_actualizacion' => $this->fecha_ultima_actualizacion,
            'maximo_credito'             => $this->maximo_credito,
            'saldo'                      => $this->saldo,
            'vehiculo'                   => $this->m_Vehiculo
        ]
    }

}
?>
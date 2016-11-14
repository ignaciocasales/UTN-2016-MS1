<?php

namespace Modelo;

class MovimientoCuentaCorriente
{

	private $fecha_hora;
	private $importe;
	private $m_EventoPeaje;
	private $m_CuentaCte;
    private $m_EventoMulta;

	function __construct($fecha_hora,$importe,$eventoP,$cuenta,$eventoM)
	{
        $this->fecha_hora = $fecha_hora;
        $this->importe = $importe;
        $this->m_EventoPeaje = $eventoP;
        $this->m_EventoMulta = $eventoM;
        $this->m_CuentaCte = $cuenta;
	}

	function __destruct(){}

    public function setFecha($fecha){
        $this->fecha_hora = $fecha;
    }
    public function setImporte($importe){
        $this->importe = $importe;

    }    
    public function setEventoPeaje($eventoP){
        $this->m_EventoPeaje = $eventoP;

    } 
    public function setEventoMulta($eventoM){
        $this->m_EventoMulta = $eventoM;
    }
    public function setCuenta($m_CuentaCte){
        $this->m_CuentaCte = $m_CuentaCte;

    }
    
    public function getFecha(){
        return $this->fecha_hora;

    }
    
    public function getImporte(){
        return $this->importe;
    }
    
    public function getEventoPeaje(){
        return $this->m_EventoPeaje;
    }
    
    public function getEventoMulta(){
        return $this->m_EventoMulta;
    }
    public function getCuenta(){
        return $this->m_CuentaCte;
    }

}
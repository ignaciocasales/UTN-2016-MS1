<?php
require_once ('Pago.php');
require_once ('CuentaCte.php');

namespace Modelo;



use Modelo;
use Modelo;
use Modelo;
/**
 * @author Damian
 * @version 1.0
 * @created 22-oct-2016 05:06:30 p.m.
 */
class MovimientoCuentaClte implements JsonSerializable
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
    public function setImporte(){
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
        return $this->fecha_hora = $fecha;

    }
    
    public function getImporte(){
        return $this->importe = $importe;
    }
    
    public function getEventoPeaje(){
        return $this->m_EventoPeaje;
    }
    
    public function getEventoMulta(){
        return $this->m_EventoMulta;
    }
    public function getCuenta(){
        return $this->m_CuentaCte = $m_CuentaCte;
    }
    
    public function jsonSerialize(){
        return [
            'fecha_hora'    => $this->fecha_hora,
            'importe'       => $this->importe,
            'evento_peaje'  => $this->m_EventoPeaje,
            'evento_multa'  => $this->m_EventoMulta,
            'cuenta'        => $this->m_CuentaCte
        ]
    }
}
?>
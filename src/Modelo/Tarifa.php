<?php


namespace Modelo;


/**
 * @author Damian
 * @version 1.0
 * @created 22-oct-2016 05:08:15 p.m.
 */
class Tarifa
{

	private $fecha_desde;
	private $fecha_hasta;
	private $multa;
	private $peaje_horas_normal;
	private $peaje_horas_pico;

	function __construct($fecha_desde,$fecha_hasta,$multa,$peaje_horas_normal,$peaje_horas_pico)
	{
        $this->fecha_desde = $fecha_desde;
        $this->fecha_hasta = $fecha_hasta;
        $this->multa = $multa;
        $this->peaje_horas_normal = $peaje_horas_normal;
        $this->peaje_horas_pico = $peaje_horas_pico;
	}

	function __destruct(){}

    public function setFechaDesde($fecha_desde){
        $this->fecha_desde = $fecha_desde;
    }
    public function setFechaHasta($fecha_hasta){
         $this->fecha_hasta = $fecha_hasta;
    }    
    public function setMulta($multa){
        $this->multa = $multa;
    }    
    public function setPeajeHorasNormal($peaje_horas_normal){
        $this->peaje_horas_normal = $peaje_horas_normal;
    }    
    public function setPeajeHorasPico($peaje_horas_pico){
        $this->peaje_horas_pico = $peaje_horas_pico;
    }
    
    public function getFechaDesde(){
        return $this->fecha_desde;
    }
    public function getFechaHasta(){
        return $this->fecha_hasta;
    }    
    public function getMulta(){
        return $this->multa;
    }    
    public function setPeajeHorasNormal(){
        return $this->peaje_horas_normal;
    }    
    public function setPeajeHorasPico(){
        return $this->peaje_horas_pico;
    }
    
    public function jsonSerialize(){
        return [
            'fecha_desde'        => $this->fecha_desde,
            'fecha_hasta'        => $this->fecha_hasta,
            'multa'              => $this->multa,
            'peaje_horas_normal' => $this->peaje_horas_normal,
            'peaje_horas_pico'   => $this->peaje_horas_pico
        ]
    }

}
?>
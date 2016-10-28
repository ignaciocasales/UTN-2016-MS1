<?php
require_once ('SensorSemaforo.php');
require_once ('MovimientoCuentaClte.php');

namespace Modelo;



use Modelo;
/**
 * @author Damian
 * @version 1.0
 * @created 22-oct-2016 05:06:47 p.m.
 */
class EventoMulta implements JsonSerializable
{

	private $fecha_hora;
	private $foto;
	private $m_SensorSemaforo;

	function __construct($fecha_hora,$foto,$m_SensorSemaforo)
	{
        $this->fecha_hora = $fecha_hora;
        $this->foto = $foto;
        $this->m_SensorSemaforo = $m_SensorSemaforo;
	}

	function __destruct()
	{
	}
    
    public function setFecha($fecha){
        $this->fecha_hora = $fecha;
    }
    public function setFoto($foto){
        $this->foto = $foto;
    }
    public function setSensorSemaforo($sensor){
        $this->m_SensorSemaforo = $sensor;
    }
    public function getFecha(){
        return $this->fecha_hora;
    }
    public function getFoto(){
        return $this->foto;
    }
    public function getSensorSemaforo(){
        return $this->m_SensorSemaforo;
    }
    
    public function jsonSerialize(){
        return [
            'fecha_hora' => $this->fecha_hora,
            'foto' => $this->foto,
            'sensorSemaforo' => $this->m_SensorSemaforo,
        ]
    }



}
?>
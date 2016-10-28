<?php


namespace Modelo;


/**
 * @author Damian
 * @version 1.0
 * @created 22-oct-2016 05:06:54 p.m.
 */

use Modelo;

class Pago implements JsonSerializable
{

	private $fecha;
    private $m_MovimientoCuentaClte;

	function __construct($fecha,$m_MovimientoCuentaClte)
	{
        $this->fecha = $fecha;
        $this->m_MovimientoCuentaClte = $m_MovimientoCuentaClte;
	}

	function __destruct(){}

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function setMovimientoCuentaClte($movimientoCuentaClte){
        $this->m_MovimientoCuentaClte = $movimientoCuentaClte;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getMovimientoCuentaClte(){
        return $this->m_MovimientoCuentaClte;
    }
    public function jsonSerialize(){
        return [
            'fecha' => $this->fecha,
            'movimiento_cuenta_cliente' => $this->m_MovimientoCuentaClte
        ]
    }

}
?>
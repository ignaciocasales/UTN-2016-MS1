<?php

namespace Modelo;

class Pago
{

    private $fecha;
    private $m_MovimientoCuentaClte;

    function __construct($fecha, $m_MovimientoCuentaClte)
    {
        $this->fecha = $fecha;
        $this->m_MovimientoCuentaClte = $m_MovimientoCuentaClte;
    }

    function __destruct()
    {
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setMovimientoCuentaClte($movimientoCuentaClte)
    {
        $this->m_MovimientoCuentaClte = $movimientoCuentaClte;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getMovimientoCuentaClte()
    {
        return $this->m_MovimientoCuentaClte;
    }

}
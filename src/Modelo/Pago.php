<?php

namespace Modelo;

class Pago
{
    private $id;
    private $fecha;
    private $movimientoCuentaCorriente;

    function __construct($fecha, $movimientoCuentaCorriente)
    {
        $this->fecha = $fecha;
        $this->movimientoCuentaCorriente = $movimientoCuentaCorriente;
    }

    function __destruct()
    {
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setMovimientoCuentaCorriente($movimientoCuentaClte)
    {
        $this->movimientoCuentaCorriente = $movimientoCuentaClte;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getMovimientoCuentaCorriente()
    {
        return $this->movimientoCuentaCorriente;
    }

}
<?php

namespace Modelo;

class MovimientoCuentaCorriente
{
    private $id = null;
    private $fechaYhora;
    private $importe;
    private $eventoPeaje = null;
    private $eventoMulta = null;
    private $cuentaCorriente;


    public function __construct($fechaYhora, $importe, CuentaCorriente $cuentaCorriente)
    {
        $this->fechaYhora = $fechaYhora;
        $this->importe = $importe;
        $this->cuentaCorriente = $cuentaCorriente;
    }

    public function __destruct()
    {
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFechaYhora($fechaYhora)
    {
        $this->fechaYhora = $fechaYhora;
    }

    public function setImporte($importe)
    {
        $this->importe = $importe;
    }

    public function setEventoPeaje($eventoP)
    {
        $this->eventoPeaje = $eventoP;
    }

    public function setEventoMulta($eventoM)
    {
        $this->eventoMulta = $eventoM;
    }

    public function setCuentaCorriente($cuentaCorriente)
    {
        $this->cuentaCorriente = $cuentaCorriente;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFechaYhora()
    {
        return $this->fechaYhora;
    }

    public function getImporte()
    {
        return $this->importe;
    }

    public function getEventoPeaje()
    {
        return $this->eventoPeaje;
    }

    public function getEventoMulta()
    {
        return $this->eventoMulta;
    }

    public function getCuentaCorriente()
    {
        return $this->cuentaCorriente;
    }
}

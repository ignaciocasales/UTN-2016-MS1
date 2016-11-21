<?php

namespace Modelo;

class EventoMulta
{
    private $id = null;
    private $fechaYhora;
    private $sensorSemaforo = null;

    function __construct($fecha_hora, $sensorSemaforo)
    {
        $this->fechaYhora = $fecha_hora;
        $this->sensorSemaforo = $sensorSemaforo;
    }

    function __destruct()
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

    public function setSensorSemaforo($sensor)
    {
        $this->sensorSemaforo = $sensor;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFechaYhora()
    {
        return $this->fechaYhora;
    }

    public function getSensorSemaforo()
    {
        return $this->sensorSemaforo;
    }

    public function jsonSerialize()
    {
        return [
            'fecha_hora' => $this->fechaYhora,
            'sensorSemaforo' => $this->sensorSemaforo,
        ];
    }

}

<?php

namespace Modelo;

class EventoMulta
{
    private $id;
    private $fechaYhora;
    private $sensorSemaforo;

    function __construct($fecha_hora)
    {
        $this->fechaYhora = $fecha_hora;
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

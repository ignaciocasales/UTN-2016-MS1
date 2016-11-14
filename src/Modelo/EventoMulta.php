<?php

namespace Modelo;

class EventoMulta
{
    private $id;
    private $fechaYhora;
    private $foto;
    private $sensorSemaforo;

    function __construct($fecha_hora, $foto, $sensorSemaforo)
    {
        $this->fechaYhora = $fecha_hora;
        $this->foto = $foto;
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

    public function setFoto($foto)
    {
        $this->foto = $foto;
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

    public function getFoto()
    {
        return $this->foto;
    }

    public function getSensorSemaforo()
    {
        return $this->sensorSemaforo;
    }

    public function jsonSerialize()
    {
        return [
            'fecha_hora' => $this->fechaYhora,
            'foto' => $this->foto,
            'sensorSemaforo' => $this->sensorSemaforo,
        ];
    }

}

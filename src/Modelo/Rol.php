<?php

namespace Modelo;

class Rol
{

    private $descripcion;

    function __construct($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function __destruct()
    {
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

}
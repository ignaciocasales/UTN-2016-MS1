<?php

namespace Modelo;

class Rol
{
    private $id;
    private $descripcion;

    public function __construct($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function __destruct()
    {
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }
}

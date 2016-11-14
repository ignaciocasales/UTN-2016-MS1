<?php

namespace Modelo;

class Rol
{
    private $id;
    private $descripcion;

    function __construct($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function __destruct()
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
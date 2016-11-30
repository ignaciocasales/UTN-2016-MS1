<?php

namespace Modelo;

class Titular
{
    private $id;
    private $apellido;
    private $dni;
    private $nombre;
    private $telefono;
    private $Usuario;

    public function __construct($nombre, $apellido, $dni, $telefono, Usuario $usuario)
    {
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->Usuario = $usuario;
    }

    public function __destruct()
    {
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setUsuario($usuario)
    {
        $this->Usuario = $usuario;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getUsuario()
    {
        return $this->Usuario;
    }
}

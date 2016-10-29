<?php

namespace Modelo;

class Usuario
{

    private $email;
    private $nombre;
    private $password;
    private $m_Rol;

    function __construct($email, $nombre, $password, $rol)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->m_Rol = $rol;
    }

    function __destruct()
    {
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRol($rol)
    {
        $this->m_Rol = $rol;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRol()
    {
        return $this->m_Rol;
    }
}
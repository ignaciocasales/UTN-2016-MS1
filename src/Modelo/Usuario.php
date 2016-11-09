<?php

namespace Modelo;

class Usuario
{

    private $email;
    private $password;
    private $m_Rol;

    function __construct($email, $password, $rol)
    {
        $this->email = $email;
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

    public function getPassword()
    {
        return $this->password;
    }

    public function getRol()
    {
        return $this->m_Rol;
    }
}
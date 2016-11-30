<?php

namespace Modelo;

class Usuario
{
    private $id;
    private $email;
    private $password;
    private $rol;

    public function __construct($email, $password, Rol $rol)
    {
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
    }

    public function __destruct()
    {
    }

    public function setId($id)
    {
        $this->id = $id;
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
        $this->rol = $rol;
    }

    public function getId()
    {
        return $this->id;
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
        return $this->rol;
    }
}

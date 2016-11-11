<?php

namespace Modelo;

class Usuario implements \JsonSerializable
{
    private $email;
    private $password;
    private $rol;

    function __construct($email, $password, $rol)
    {
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
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
        $this->rol = $rol;
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

    function jsonSerialize()
    {
        return [
            'mail' => $this->email,
            'pwd' => $this->password,
            'id_roles' => $this->rol
        ];
    }
}
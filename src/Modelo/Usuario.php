<?php

namespace Modelo;

class Usuario implements \JsonSerializable
{
    private $email;
    private $password;
    private $rol;
    private $id = 0;

    function __construct($id, $email, $password, $rol)
    {
        $this->id = $id;
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

    public function setId($id)
    {
        $this->id = $id;
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

    public function getId()
    {
        return $this->id;
    }

    function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'mail' => $this->email,
            'pwd' => $this->password,
            'id_roles' => $this->rol
        ];
    }
}
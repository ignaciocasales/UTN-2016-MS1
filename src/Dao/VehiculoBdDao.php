<?php

namespace Dao;


class VehiculoBdDao implements VehiculoIDao
{
    protected $tabla = "vehiculos";
    protected $listado;
    private static $instancia;

    public static function getInstancia()
    {
        if (!self::$instancia instanceof self) {

            self::$instancia = new self();

        }

        return self::$instancia;
    }

    public function agregar($vehiculo)
    {
        $sql = "INSERT INTO $this->tabla (dominio, marca, modelo, id_titulares) VALUES (:dominio, :marca, :modelo, (SELECT id_titulares FROM titulares WHERE dni = :dni))";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $dominio = $vehiculo->getDominio();
        $marca   = $vehiculo->getMarca();
        $modelo  = $vehiculo->getModelo();
        $titular = $vehiculo->getTitular();
        $dni     = $titular->getDni();

        $sentencia->bindParam(":dominio", $dominio);
        $sentencia->bindParam(":marca", $marca);
        $sentencia->bindParam(":modelo", $modelo);
        $sentencia->bindParam(":dni", $dni);


        $sentencia->execute();

    }
}
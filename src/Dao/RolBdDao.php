<?php

namespace Dao;


class RolBdDao extends Conexion implements IDao
{

    public function agregar($valor)
    {
        // TODO: Implement agregar() method.
    }

    public function eliminar($valor)
    {
        // TODO: Implement eliminar() method.
    }

    public function actualizar($valor)
    {
        // TODO: Implement actualizar() method.
    }

    public function traeTodo()
    {
        // TODO: Implement traeTodo() method.
    }

    public function traeUno($valor)
    {
        $sql = "SELECT * FROM $this->tabla WHERE descripcion =  '$valor'";

        $obj_pdo = new Conexion();

        $conexion = $obj_pdo->conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $row = $sentencia->fetch(\PDO::FETCH_ASSOC);

        if (!empty($row)) return $row;
    }
}
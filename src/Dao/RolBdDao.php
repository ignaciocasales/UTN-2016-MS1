<?php

namespace Dao;


use Modelo\Rol;

// TERMINADO //

class RolBdDao implements RolIDao
{
    protected $tabla = "roles";
    private static $instancia;
    protected $listado;

    public static function getInstancia()
    {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function agregar($rol)
    {
        $sql = "INSERT INTO $this->tabla (descripcion) VALUES (:descripcion)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $descripcion = $rol->getDescripcion();

        $sentencia->bindParam(":descripcion", $descripcion);

        $sentencia->execute();
    }

    public function eliminar($descripcion)
    {
        $sql = "DELETE FROM $this->tabla WHERE descripcion = '$descripcion'";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }

    public function actualizar($rol)
    {
        $sql = "UPDATE $this->tabla SET descripcion = :descripcion WHERE descripcion = :descripcion";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $descripcion = $rol->getDescripcion();

        $sentencia->bindParam(":descripcion", $descripcion);

        $sentencia->execute();
    }

    public function traeTodo()
    {
        $sql = "SELECT * FROM $this->tabla";
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare($sql);

        $dataSet = $sentencia->fetchall(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado)) return $this->listado;

    }

    public function traerPorId($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_roles =  '$id' LIMIT 1";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) return $this->listado[0];
    }

    public function mapear($dataSet)
    {
        $dataSet = is_array($dataSet) ? $dataSet : [];
        $this->listado = array_map(function ($p) {
            return new Rol($p['descripcion']);
        }, $dataSet);
    }
}
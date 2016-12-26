<?php

namespace Dao;

use Modelo\Rol;

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

    private function __construct()
    {
    }

    public function agregar(Rol $rol)
    {
        /** @noinspection SqlResolve */
        $sql = "INSERT INTO $this->tabla (descripcion) VALUES (:descripcion)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $descripcion = $rol->getDescripcion();

        $sentencia->bindParam(":descripcion", $descripcion);

        $sentencia->execute();

        return $conexion->lastInsertId();
    }

    public function eliminar($id)
    {
        /** @noinspection SqlResolve */
        $sql = "DELETE FROM $this->tabla WHERE descripcion = \"$id\"";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }

    public function actualizar(Rol $rol)
    {
        $sql = "UPDATE $this->tabla 
                  SET descripcion = :descripcion 
                WHERE id_roles = :idRoles";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $idRoles = $rol->getId();

        $sentencia->bindParam(":idRoles", $idRoles);

        $sentencia->execute();
    }

    public function traeTodo()
    {
        $sql = "SELECT * FROM $this->tabla";
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare($sql);

        $dataSet = $sentencia->fetchall(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado)) {
            return $this->listado;
        }
        return null;
    }

    public function traerPorId($id)
    {
        /** @noinspection SqlResolve */
        $sql = "SELECT * FROM $this->tabla WHERE idRol = \"$id\" LIMIT 1";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) {
            return $this->listado[0];
        }
        return null;
    }

    public function mapear($dataSet)
    {
        $dataSet = is_array($dataSet) ? $dataSet : [];
        $this->listado = array_map(function ($p) {
            $r = new Rol($p['descripcion']);
            $r->setId($p['idRol']);
            return $r;
        }, $dataSet);
    }
}

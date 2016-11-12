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

    public function agregar($rol)
    {
        $sql = "INSERT INTO $this->tabla (descripcion) VALUES (:descripcion)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $descripcion = $rol->getDescripcion();

        $sentencia->bindParam(":descripcion", $descripcion);

        $sentencia->execute();
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
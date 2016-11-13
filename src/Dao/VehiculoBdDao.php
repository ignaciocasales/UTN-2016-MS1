<?php

namespace Dao;


use Modelo\Vehiculo;

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
        $marca = $vehiculo->getMarca();
        $modelo = $vehiculo->getModelo();
        $titular = $vehiculo->getTitular();
        $dni = $titular->getDni();

        $sentencia->bindParam(":dominio", $dominio);
        $sentencia->bindParam(":marca", $marca);
        $sentencia->bindParam(":modelo", $modelo);
        $sentencia->bindParam(":dni", $dni);


        $sentencia->execute();

    }

    public function eliminarPorDominio($dominio)
    {
        $sql = "DELETE FROM $this->tabla WHERE dominio = \"$dominio\"";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }

    public function actualizar($vehiculo)
    {
        //No tiene sentido cambiar otro dato que no sea el titular.
        $sql = "UPDATE $this->tabla SET id_titulares = (SELECT id_titulares FROM titulares WHERE dni = :dni) WHERE dominio = :dominio";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $dominio = $vehiculo->getDominio();

        $t = $vehiculo->getTitular();
        $dni = $t->getDni();

        $sentencia->bindParam(":dominio", $dominio);
        $sentencia->bindParam(":dni", $dni);

        $sentencia->execute();
    }

    public function traerTodo()
    {
        $sql = "SELECT * FROM $this->tabla";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet = $sentencia->fetchall(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado)) return $this->listado;
    }

    public function traerPorId($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_vehiculos =  \"$id\" LIMIT 1";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) return $this->listado[0];
    }

    public function traerPorDominio($dominio)
    {
        $sql = "SELECT * FROM $this->tabla WHERE dominio =  \"$dominio\" LIMIT 1";

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
            $daoTitular = TitularBdDao::getInstancia();
            return new Vehiculo($p['dominio'], $p['marca'], $p['modelo'], $daoTitular->traerPorId($p['id_titulares']), $p['qr']);
        }, $dataSet);
    }
}
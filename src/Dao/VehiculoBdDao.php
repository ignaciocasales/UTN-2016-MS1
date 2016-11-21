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
        $sql = "INSERT INTO $this->tabla (dominio, marca, modelo, id_titulares, qr) VALUES (:dominio, :marca, :modelo, :idTitular, :qr)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $dominio = $vehiculo->getDominio();
        $marca = $vehiculo->getMarca();
        $modelo = $vehiculo->getModelo();

        $t = $vehiculo->getTitular();
        $idTitular = $t->getId();

        $qr = $vehiculo->getQR();

        $sentencia->bindParam(":dominio", $dominio);
        $sentencia->bindParam(":marca", $marca);
        $sentencia->bindParam(":modelo", $modelo);
        $sentencia->bindParam(":idTitular", $idTitular);
        $sentencia->bindParam(":qr", $qr);

        $sentencia->execute();

    }

    public function eliminarPorId($id)
    {
        $sql = "DELETE FROM $this->tabla WHERE id_vehiculos = \"$id\"";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

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
        $sql = "UPDATE $this->tabla SET id_titulares = :idTitular WHERE id_vehiculos = :idVehiculo";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $idVehiculo = $vehiculo->getId();

        $t = $vehiculo->getTitular();
        $idTitular = $t->getId();

        $sentencia->bindParam(":idVehiculo", $idVehiculo);
        $sentencia->bindParam(":idTitular", $idTitular);

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

    public function traerPorIdTitular($id){
        $sql = "SELECT * FROM $this->tabla WHERE id_titular = '$id'";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        print_r($dataSet);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) return $this->listado[0];

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

            $v = new Vehiculo($p['dominio'], $p['marca'], $p['modelo'], $daoTitular->traerPorId($p['id_titulares']), $p['qr']);

            $v->setId($p['id_vehiculos']);

            return $v;

        }, $dataSet);
    }
}
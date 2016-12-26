<?php

namespace Dao;

use Modelo\CuentaCorriente;

class CuentaCorrienteBdDao implements CuentaCorrienteIDao
{
    protected $tabla = "cuentas_corrientes";
    protected $listado;
    private static $instancia;

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

    public function agregar(CuentaCorriente $cuenta_corriente)
    {
        /** @noinspection SqlResolve */
        $sql = "INSERT INTO $this->tabla (ultimaActualizacion, maximoCredito, saldo, idVehiculo) 
                    VALUES (:ultimaActualizacion, :maximoCredito, :saldo, :idVehiculo)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $ultimaActualizacion = $cuenta_corriente->getFechaUltimaActualizacion();
        $maximoCredito = $cuenta_corriente->getMaximoCredito();
        $saldo = $cuenta_corriente->getSaldo();

        $vehiculo = $cuenta_corriente->getVehiculo();
        $idVehiculo = $vehiculo->getId();

        $sentencia->bindParam(":ultimaActualizacion", $ultimaActualizacion);
        $sentencia->bindParam(":maximoCredito", $maximoCredito);
        $sentencia->bindParam(":saldo", $saldo);
        $sentencia->bindParam(":idVehiculo", $idVehiculo);

        $sentencia->execute();

        return $conexion->lastInsertId();
    }

    public function eliminar($id)
    {
        /** @noinspection SqlResolve */
        $sql = "DELETE FROM $this->tabla WHERE idCuentaCorriente = \"$id\")";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }

    public function actualizar(CuentaCorriente $cuentaCorriente)
    {
        /** @noinspection SqlResolve */
        $sql = "UPDATE $this->tabla
                  SET ultimaActualizacion = :fechaUltimaActualizacion, saldo = :saldo 
                WHERE idCuentaCorriente = :idCuentaCorriente";

        $conexion = Conexion::conectar();

        $conexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $sentencia = $conexion->prepare($sql);

        $fechaUltimaActualizacion = $cuentaCorriente->getFechaUltimaActualizacion();
        $saldo = $cuentaCorriente->getSaldo();
        $idCuentaCorriente = $cuentaCorriente->getId();

        $sentencia->bindParam(":fechaUltimaActualizacion", $fechaUltimaActualizacion);
        $sentencia->bindParam(":saldo", $saldo);
        $sentencia->bindParam(":idCuentaCorriente", $idCuentaCorriente);

        $sentencia->execute();
    }

    public function traerTodo()
    {
        $sql = "SELECT * FROM $this->tabla";

        $sentencia = Conexion::conectar()->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetchall(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado)) {
            return $this->listado;
        }
        return null;
    }

    public function traerPorId($id)
    {
        /** @noinspection SqlResolve */
        $sql = "SELECT * FROM $this->tabla WHERE idCuentaCorriente =  \"$id\"";

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

    public function traerPorVehiculo($id)
    {
        /** @noinspection SqlResolve */
        $sql = "SELECT * FROM $this->tabla WHERE idVehiculo =  \"$id\"";

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

            $daoVehiculo = VehiculoBdDao::getInstancia();

            $cc = new CuentaCorriente(
                $p['ultimaActualizacion'],
                $p['maximoCredito'],
                $p['saldo'],
                $daoVehiculo->traerPorId($p['idVehiculo'])
            );

            $cc->setId($p['idCuentaCorriente']);

            return $cc;
        }, $dataSet);
    }
}

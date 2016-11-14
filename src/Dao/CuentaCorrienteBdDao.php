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

    public function agregar($cuenta_corriente)
    {
        $sql = "INSERT INTO $this->tabla (fecha_ultima_actualizacion, maximo_credito, saldo, id_vehiculos) VALUES (:fecha_ultima_actualizacion, :maximo_credito, :saldo, :idVehiculo)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $fecha_ultima_actualizacion = $cuenta_corriente->getFecha();
        $maximo_credito = $cuenta_corriente->getMaximoCredito();
        $saldo = $cuenta_corriente->getSaldo();
        $vehiculo = $cuenta_corriente->getVehiculo();
        $idVehiculo = $vehiculo->getId();

        $sentencia->bindParam(":fecha_ultima_actualizacion", $fecha_ultima_actualizacion);
        $sentencia->bindParam(":maximo_credito", $maximo_credito);
        $sentencia->bindParam(":saldo", $saldo);
        $sentencia->bindParam(":idVehiculo", $idVehiculo);

        $sentencia->execute();

    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM $this->tabla WHERE id_cuentas_corrientes = \"$id\")";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }

    public function actualizar($cuentaCorriente)
    {
        $sql = "UPDATE $this->tabla SET fecha_ultima_actualizacion = :fechaUltimaActualizacion, saldo = :saldo, maximo_credito = :maximoCredito WHERE id_cuentas_corrientes = :idCuentaCorriente)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $fechaUltimaActualizacion = $cuentaCorriente->getFechaUltimaActualizacion();
        $saldo = $cuentaCorriente->getSaldo();
        $maximoCredito = $cuentaCorriente->getMaximoCredito();
        $idCuentaCorriente = $cuentaCorriente->getId();

        $sentencia->bindParam(":fechaUltimaActualizacion", $fechaUltimaActualizacion);
        $sentencia->bindParam(":saldo", $saldo);
        $sentencia->bindParam(":maximoCredito", $maximoCredito);
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

        if (!empty($this->listado[0])) return $this->listado[0];

    }

    public function traerPorId($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_cuentas_corrientes =  \"$id\"";

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
            $daoVehiculo = VehiculoBdDao::getInstancia();
            return new CuentaCorriente($p['fecha_ultima_actualizacion'], $p['maximo_credito'], $p['saldo'], $daoVehiculo->traerPorId($p['id_vehiculos']));
        }, $dataSet);
    }
}
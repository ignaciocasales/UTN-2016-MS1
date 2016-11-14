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

    public function traerPorId($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_cuentas_corrientes =  '$id'";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) return $this->listado[0];
    }

    public function agregar($cuenta_corriente)
    {
        $sql = "INSERT INTO $this->tabla (fecha_ultima_actualizacion, maximo_credito, saldo, id_vehiculos) VALUES (:fecha_ultima_actualizacion, :maximo_credito, :saldo, (SELECT id_vehiculos FROM vehiculos WHERE dominio = :dominio))";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $fecha_ultima_actualizacion = $cuenta_corriente->getFecha();
        $maximo_credito = $cuenta_corriente->getMaximoCredito();
        $saldo = $cuenta_corriente->getSaldo();
        $vehiculo = $cuenta_corriente->getVehiculo();
        $dominio  = $vehiculo->getDominio();


        $sentencia->bindParam(":fecha_ultima_actualizacion", $fecha_ultima_actualizacion);
        $sentencia->bindParam(":maximo_credito", $maximo_credito);
        $sentencia->bindParam(":saldo", $saldo);
        $sentencia->bindParam(":dominio", $dominio);


        $sentencia->execute();

    }

    public function eliminar($cuentas_corrientes)
    {
        $sql = "DELETE FROM $this->tabla WHERE id_cuentas_corrientes = (SELECT id_cuentas_corrientes FROM cuentas_corrientes WHERE id_vehiculos = 
        (SELECT id_vehiculos FROM vehiculos WHERE dominio = :dominio))";

        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare($sql);
        $vehiculo = $cuentas_corrientes->getVehiculo();
        $dominio = $vehiculo->getDominio();

        $sentencia->bindParam(":dominio",$dominio);


        $sentencia->execute();
    }

    public function traerTodo(){
        $sql = "SELECT * FROM $this->tabla ";
        $sentencia = Conexion::conectar()->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetchall(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) return $this->listado[0];

    }

    public function actualizar($cuentas_corrientes)
    {
        $sql = "UPDATE $this->tabla SET :fecha_ultima_actualizacion = fecha_ultima_actualizacion , :saldo=saldo, :maximo_credito = maximo_credito, :id_vehiculos = (SELECT id_vehiculos FROM vehiculos WHERE dominio = :dominio)
        WHERE id_cuentas_corrientes = (SELECT id_cuentas_corrientes FROM cuentas_corrientes WHERE id_vehiculos = 
        (SELECT id_vehiculos FROM vehiculos WHERE dominio = :dominio))";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $fecha_ultima_actualizacion = $cuentas_corrientes->getFecha();
        $saldo = $cuentas_corrientes->getSaldo();
        $maximo_credito = $cuentas_corrientes->getMaximoCredito();
        $vehiculo = $cuentas_corrientes->getVehiculo();
        $dominio = $vehiculo->getDominio();


        $sentencia->bindParam(":fecha_ultima_actualizacion", $fecha_ultima_actualizacion);
        $sentencia->bindParam(":saldo", $saldo);
        $sentencia->bindParam(":maximo_credito", $maximo_credito);
        $sentencia->bindParam(":dominio", $dominio);

        $sentencia->execute();

    }

    public function mapear($dataSet){
        $dataSet = is_array($dataSet) ? $dataSet : [];
        $this->listado = array_map(function ($p) {
            $daoVehiculo = VehiculoBdDao::getInstancia();
            return new CuentaCorriente($p['fecha_ultima_actualizacion'], $p['maximo_credito'], $p['saldo'], $daoVehiculo->traerPorId($p['id_vehiculos']));
        }, $dataSet);
    }
}
<?php

namespace Dao;


//// NO TERMINADO /////
class MovimientoCuentaCorrienteBdDao
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
        $sql = "SELECT * FROM $this->tabla WHERE id_movimientos =  '$id'";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) return $this->listado[0];
    }

    public function agregar($movimientosCC)
    {
        $sql = "INSERT INTO $this->tabla (fecha_hora, importe, id_cuentas_corrientes, id_eventos) VALUES (:fecha_hora, :importe, 
        (SELECT id_cuentas_corrientes FROM cuentas_corrientes WHERE id_vehiculos = (SELECT id_vehiculos FROM vehiculos WHERE dominio = :dominio)), 
        (SELECT id_eventos FROM eventos WHERE id_sensores = (SELECT id_sensores FROM sensores WHERE numeros_serie = :numeros_serie)))";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $fecha_hora = $movimientosCC->getFecha();
        $importe = $movimientosCC->getImporte();
        $cuentas_corrientes = $movimientosCC->getCuenta();
        $sensores = $movimientosCC->getSensor();
        $vehiculo = $cuentas_corrientes->getVehiculo();
        $dominio = $vehiculo->getDominio();

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
        $sql = "UPDATE $this->tabla SET fecha_ultima_actualizacion = :fecha_ultima_actualizacion , saldo=:saldo, maximo_credito = :maximo_credito, id_vehiculos = (SELECT id_vehiculos FROM vehiculos WHERE dominio = :dominio)
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

           // return new CuentaCorriente($p['fecha_ultima_actualizacion'], $p['maximo_credito'], $p['saldo'], $daoVehiculo->traerPorId($p['id_vehiculos']));
        }, $dataSet);
    }
}
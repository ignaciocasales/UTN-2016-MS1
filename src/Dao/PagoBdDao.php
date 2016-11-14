<?php

namespace Dao;


use Modelo\Pago;

// TERMINADO //

class PagoBdDao implements PagoIDao
{
    protected $tabla = "pagos";
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
        $sql = "SELECT * FROM $this->tabla WHERE id_pagos =  '$id'";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) return $this->listado[0];
    }

    public function agregar($pago)
    {
        $sql = "INSERT INTO $this->tabla (fecha, id_movimientos) VALUES (:fecha, (SELECT id_movimientos FROM movimientos_cuentas_corrientes WHERE id_cuentas_corrientes = (SELECT id_cuentas_corrientes FROM cuentas_corrientes 
        WHERE id_vehiculos = (SELECT id_vehiculos FROM vehiculos WHERE dominio = :dominio))))";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $fecha = $pago->getFecha();
        $movimientoCuentaClte = $pago->getMovimientoCuentaClte();
        $cuenta_corriente = $movimientoCuentaClte->getCuenta();
        $vehiculo = $cuenta_corriente->getVehiculo();
        $dominio  = $vehiculo->getDominio();


        $sentencia->bindParam(":fecha", $fecha);
        $sentencia->bindParam(":dominio", $dominio);


        $sentencia->execute();

    }

    public function eliminar($pago)
    {
        $sql = "DELETE FROM $this->tabla WHERE id_pagos = (SELECT id_pagos FROM pagos WHERE id_movimientos = 
        (SELECT id_movimientos FROM movimientos_cuentas_corrientes WHERE id_cuentas_corrientes = 
        (SELECT id_cuentas_corrientes FROM cuentas_corrientes WHERE id_vehiculos = 
        (SELECT id_vehiculos FROM vehiculos WHERE dominio = :dominio))))";

        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare($sql);
        $movimientos = $pago->getMovimientoCuentaClte();
        $cuenta_corriente = $movimientos->getCuenta();
        $vehiculo = $cuenta_corriente->getVehiculo();

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

    public function actualizar($pago)
    {
        $sql = "UPDATE $this->tabla SET fecha = :fecha , id_movimientos = 
        (SELECT id_movimientos FROM movimientos_cuentas_corrientes WHERE id_cuentas_corrientes = 
        (SELECT id_cuentas_corrientes FROM cuentas_corrientes WHERE id_vehiculos = 
        (SELECT id_vehiculos FROM vehiculos WHERE dominio = :dominio))) 
        
        WHERE id_pagos = (SELECT id_pagos FROM pagos WHERE id_movimientos = 
        
        (SELECT id_movimientos FROM movimientos_cuentas_corrientes WHERE id_cuentas_corrientes = 
        (SELECT id_cuentas_corrientes FROM cuentas_corrientes WHERE id_vehiculos = 
        (SELECT id_vehiculos FROM vehiculos WHERE dominio = :dominio))))";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $fecha = $pago->getFecha();
        $movimientoCuentaClte = $pago->getMovimientoCuentaClte();
        $cuenta_corriente = $movimientoCuentaClte->getCuenta();
        $vehiculo = $cuenta_corriente->getVehiculo();
        $dominio  = $vehiculo->getDominio();


        $sentencia->bindParam(":fecha", $fecha);
        $sentencia->bindParam(":dominio", $dominio);


        $sentencia->execute();

    }

    public function mapear($dataSet){
        $dataSet = is_array($dataSet) ? $dataSet : [];
        $this->listado = array_map(function ($p) {
            $daoMovimientos = MovimientoCuentaCorrienteBdDao::getInstancia();
            return new Pago($p['fecha'],$daoMovimientos->traerPorId($p['id_movimientos']));
        }, $dataSet);
    }
}
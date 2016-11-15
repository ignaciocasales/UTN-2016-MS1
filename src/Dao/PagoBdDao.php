<?php

namespace Dao;


use Modelo\Pago;

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

    public function agregar($pago)
    {
        $sql = "INSERT INTO $this->tabla (fecha, id_movimientos) VALUES (:fecha, :idMovimiento)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $fecha = $pago->getFecha();

        $movimientoCuentaCorriente = $pago->getMovimientoCuentaCorriente();
        $idMovimiento = $movimientoCuentaCorriente->getId();

        $sentencia->bindParam(":fecha", $fecha);
        $sentencia->bindParam(":idMovimiento", $idMovimiento);

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
        $sql = "SELECT * FROM $this->tabla WHERE id_pagos =  \"$id\"";

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

            $daoMovimientos = MovimientoCuentaCorrienteBdDao::getInstancia();

            $pago = new Pago($p['fecha'], $daoMovimientos->traerPorId($p['id_movimientos']));

            $pago->setId($p['id_pagos']);

            return $pago;

        }, $dataSet);
    }
}
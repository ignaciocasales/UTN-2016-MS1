<?php

namespace Dao;


use Modelo\Tarifa;

class TarifaBdDao implements TarifaIDao
{
    protected $tabla = "tarifas";
    protected $listado;
    private static $instancia;

    public static function getInstancia()
    {
        if (!self::$instancia instanceof self) {

            self::$instancia = new self();

        }
        return self::$instancia;
    }

    public function agregar($tarifa)
    {
        $sql = "INSERT INTO $this->tabla (fecha_desde, fechaHasta, multa, peajeHoraNormal, peajeHoraPico) VALUES (:fechaDesde, :fechaHasta, :multa, :peajeHoraNormal, :peajeHoraPico)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $fechaDesde = $tarifa->getFechaDesde();
        $fechaHasta = $tarifa->getFechaHasta();
        $multa = $tarifa->getMulta();
        $peajeHoraNormal = $tarifa->getPeajeHorasNormal();
        $peajeHoraPico = $tarifa->getPeajeHorasPico();

        $sentencia->bindParam(":fechaDesde", $fechaDesde);
        $sentencia->bindParam(":fechaHasta", $fechaHasta);
        $sentencia->bindParam(":multa", $multa);
        $sentencia->bindParam(":peajeHoraNormal", $peajeHoraNormal);
        $sentencia->bindParam(":peajeHoraPico", $peajeHoraPico);

        $sentencia->execute();

        return $conexion->lastInsertId();
    }

    public function actualizar($tarifa)
    {
        $sql = "UPDATE $this->tabla SET fechaDesde = :fechaDesde, fechaHasta = :fechaHasta, multa = :multa, peajeHoraNormal = :peajeHoraNormal, peajeHoraPico = :peajeHoraPico WHERE id_tarifas = :id";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $fechaDesde = $tarifa->getFechaDesde();
        $fechaHasta = $tarifa->getFechaHasta();
        $multa = $tarifa->getMulta();
        $peajeHoraNormal = $tarifa->getPeajeHorasNormal();
        $peajeHoraPico = $tarifa->getPeajeHorasPico();
        $id = $tarifa->getId();

        $sentencia->bindParam(":fechaDesde", $fechaDesde);
        $sentencia->bindParam(":fechaHasta", $fechaHasta);
        $sentencia->bindParam(":multa", $multa);
        $sentencia->bindParam(":peajeHoraNormal", $peajeHoraNormal);
        $sentencia->bindParam(":peajeHoraPico", $peajeHoraPico);
        $sentencia->bindParam(":id", $id);

        $sentencia->execute();
    }

    public function traeTodo()
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
        $sql = "SELECT * FROM $this->tabla WHERE id_tarifas =  \"$id\" LIMIT 1";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) return $this->listado[0];
    }

    public function traerPorFecha($fecha)
    {
        $sql = "SELECT * FROM $this->tabla WHERE fecha_desde <=  \"$fecha\" AND fecha_hasta >= \"$fecha\" LIMIT 1";

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

            $t = new Tarifa($p['fecha_desde'], $p['fecha_hasta'], $p['multa'], $p['peaje_hora_normal'], $p['peaje_hora_pico']);

            $t->setId($p['id_tarifas']);

            return $t;

        }, $dataSet);
    }
}
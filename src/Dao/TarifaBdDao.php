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
        $sql = "INSERT INTO $this->tabla (fecha_desde, fecha_hasta, multa, peaje_hora_normal, peaje_hora_pico) VALUES (:fecha_desde, :fecha_hasta, :multa, :peaje_hora_normal, :peaje_hora_pico)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $fecha_desde = $tarifa->getFechaDesde();
        $fecha_hasta = $tarifa->getFechaHasta();
        $multa = $tarifa->getMulta();
        $peaje_hora_normal = $tarifa->getPeajeHorasNormal();
        $peaje_hora_pico = $tarifa->getPeajeHorasPico();

        $sentencia->bindParam(":fecha_desde", $fecha_desde);
        $sentencia->bindParam(":fecha_hasta", $fecha_hasta);
        $sentencia->bindParam(":multa", $multa);
        $sentencia->bindParam(":peaje_hora_normal", $peaje_hora_normal);
        $sentencia->bindParam(":peaje_hora_pico", $peaje_hora_pico);

        $sentencia->execute();
    }

    public function actualizar($tarifa)
    {
        $sql = "UPDATE $this->tabla SET fecha_desde = :fecha_desde, fecha_hasta = :fecha_hasta, multa = :multa, peaje_hora_normal = :peaje_hora_normal, peaje_hora_pico = :peaje_hora_pico WHERE id_tarifas = :id";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $fecha_desde = $tarifa->getFechaDesde();
        $fecha_hasta = $tarifa->getFechaHasta();
        $multa = $tarifa->getMulta();
        $peaje_hora_normal = $tarifa->getPeajeHorasNormal();
        $peaje_hora_pico = $tarifa->getPeajeHorasPico();
        $id = $tarifa->getId();

        $sentencia->bindParam(":fecha_desde", $fecha_desde);
        $sentencia->bindParam(":fecha_hasta", $fecha_hasta);
        $sentencia->bindParam(":multa", $multa);
        $sentencia->bindParam(":peaje_hora_normal", $peaje_hora_normal);
        $sentencia->bindParam(":peaje_hora_pico", $peaje_hora_pico);
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
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

    public function agregar(Tarifa $tarifa)
    {
        /** @noinspection SqlResolve */
        $sql = "INSERT INTO $this->tabla (fechaDesde, fechaHasta, multa, peajeHoraNormal, peajeHoraPico) 
                VALUES (:fechaDesde, :fechaHasta, :multa, :peajeHoraNormal, :peajeHoraPico)";

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

    public function actualizar(Tarifa $tarifa)
    {
        /** @noinspection SqlResolve */
        $sql = "UPDATE $this->tabla
                  SET 
                  fechaDesde = :fechaDesde,
                  fechaHasta = :fechaHasta,
                  multa = :multa,
                  peajeHoraNormal = :peajeHoraNormal,
                  peajeHoraPico = :peajeHoraPico 
                WHERE idTarifa = :id";

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

        if (!empty($this->listado)) {
            return $this->listado;
        }
        return null;
    }

    public function traerPorId($id)
    {
        $sql = "SELECT * FROM $this->tabla  WHERE idTarifa =  \"$id\" LIMIT 1";

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

    public function traerPorFecha($fecha)
    {
        /** @noinspection SqlResolve */
        $sql = "SELECT * 
                FROM $this->tabla 
                WHERE fechaDesde <=  \"$fecha\" AND fechaHasta >= \"$fecha\" 
                LIMIT 1";

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
            $t = new Tarifa(
                $p['fechaDesde'],
                $p['fechaHasta'],
                $p['multa'],
                $p['peajeHoraNormal'],
                $p['peajeHoraPico']
            );
            $t->setId($p['idTarifa']);
            return $t;
        }, $dataSet);
    }
}

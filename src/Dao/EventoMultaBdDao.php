<?php

namespace Dao;

use Modelo\EventoMulta;
use Modelo\SensorSemaforo;

class EventoMultaBdDao implements EventoIDao
{
    protected $tabla = "eventos";
    protected $listado;
    private static $instancia;

    public static function getInstancia()
    {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    /**
     * @param EventoMulta $evento
     * @return string
     */
    public function agregar($evento)
    {
        /** @noinspection SqlResolve */
        $sql = "INSERT INTO $this->tabla (fehcaHora, idTipoEvento, idSensor) VALUES (:fechaHora, :idEvento, :idSensor)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $idEvento = 1; //los eventos de multa tienen el id 1 !!!!!!
        $fechaHora = $evento->getFechaYhora();

        /** @var SensorSemaforo $s */
        $s = $evento->getSensorSemaforo();
        $idSensor = $s->getId();

        $sentencia->bindParam(":fechaHora", $fechaHora);
        $sentencia->bindParam(":idEvento", $idEvento);
        $sentencia->bindParam(":idSensor", $idSensor);

        $sentencia->execute();

        return $conexion->lastInsertId();
    }

    public function traerTodo()
    {
        $sql = "SELECT * FROM $this->tabla";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet = $sentencia->fetchAll(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado)) {
            return $this->listado;
        }
        return null;
    }

    public function traerPorId($id)
    {
        /** @noinspection SqlResolve */
        $sql = "SELECT * FROM $this->tabla 
                WHERE idEvento =  \"$id\" AND idTipoEvento = 1 
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

            if ($p['idEvento']) {
                $daoSensor = SensorSemaforoBdDao::getInstancia();
                $e = new EventoMulta($p['fechaHora'], $daoSensor->traerPorId($p{'idSensor'}));
                $e->setId($p['idEvento']);
                return $e;
            } else {
                return null;
            }
        }, $dataSet);
    }
}
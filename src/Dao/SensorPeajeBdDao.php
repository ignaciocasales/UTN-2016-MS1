<?php

namespace Dao;

use Modelo\SensorPeaje;

class SensorPeajeBdDao implements SensorIDao
{

    protected $tabla = "sensores";
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
     * @param SensorPeaje $sensor
     * @return integer
     */
    public function agregar($sensor)
    {
        /** @noinspection SqlResolve */
        $sql = "INSERT INTO $this->tabla (fechaAlta, latitud, longitud, numeroSerie, idTipoSensor) 
                VALUES (:fechaAlta, :latitud, :longitud, :numerosSerie, :idSensor)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $fechaAlta = $sensor->getFechaAlta();
        $latitud = $sensor->getLatitud();
        $longitud = $sensor->getLongitud();
        $numerosSerie = $sensor->getNumeroSerie();
        $idSensor = $sensor->getId();

        $sentencia->bindParam(":fechaAlta", $fechaAlta);
        $sentencia->bindParam(":latitud", $latitud);
        $sentencia->bindParam(":longitud", $longitud);
        $sentencia->bindParam(":numerosSerie", $numerosSerie);
        $sentencia->bindParam(":idSensor", $idSensor);

        $sentencia->execute();

        return $conexion->lastInsertId();
    }

    public function traerTodo()
    {
        /** @noinspection SqlResolve */
        $sql = "SELECT * FROM $this->tabla WHERE idTipoSensor =  \"1\"";

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
        $sql = "SELECT * FROM $this->tabla WHERE idSensor =  \"$id\" AND idTipoSensor =  \"1\" LIMIT 1";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        if ($dataSet[0] != false) {
            $this->mapear($dataSet);

            if (!empty($this->listado[0])) {
                return $this->listado[0];
            }
        }
        return null;
    }

    public function traerCualquiera()
    {
        /** @noinspection SqlResolve */
        $sql = "SELECT * FROM $this->tabla WHERE idTipoSensor =  \"1\" ORDER BY RAND() LIMIT 1";

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
            $s = new SensorPeaje($p['fechaAlta'], $p['latitud'], $p['longitud'], $p['numeroSerie']);
            $s->setId($p['idSensor']);
            return $s;
        }, $dataSet);
    }
}

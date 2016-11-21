<?php

namespace Dao;


use Modelo\SensorSemaforo;

class SensorSemaforoBdDao implements SensorIDao
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

    public function agregar($sensor)
    {
        $sql = "INSERT INTO $this->tabla (fecha_alta, latitud, longitud, numeros_serie, id_tipos_sensores) VALUES (:fechaAlta, :latitud, :longitud, :numerosSerie, :idSensor)";

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
    }

    public function traerTodo()
    {
        $sql = "SELECT * FROM $this->tabla";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet = $sentencia->fetchAll(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado)) return $this->listado;
    }

    public function traerPorId($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_sensores =  \"$id\" AND id_tipos_sensores =  \"2\" LIMIT 1";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) return $this->listado[0];
    }

    public function traerCualquiera()
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_tipos_sensores =  \"2\" ORDER BY RAND() LIMIT 1";

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

            $s = new SensorSemaforo($p['fecha_alta'], $p['latitud'], $p['longitud'], $p['numeros_serie']);

            $s->setId($p['id_sensores']);

            return $s;

        }, $dataSet);
    }
}
<?php

namespace Dao;


use Modelo\EventoPeaje;

class EventoPeajeBdDao implements EventoIDao
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

    public function agregar($evento)
    {
        $sql = "INSERT INTO $this->tabla (fecha_hora, id_tipos_eventos, id_sensores) VALUES (:fechaHora, :idEvento, :idSensor)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $idEvento = 2;
        $fechaHora = $evento->getFechaYhora();

        $s = $evento->getSensorPeaje();
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

        if (!empty($this->listado)) return $this->listado;
    }

    public function traerPorId($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_usuarios =  \"$id\" LIMIT 1";

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

            $e = new EventoPeaje($p['fecha_hora']);

            $e->setId($p['id_eventos']);

            return $e;

        }, $dataSet);
    }
}
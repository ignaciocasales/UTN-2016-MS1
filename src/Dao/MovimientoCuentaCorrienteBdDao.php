<?php

namespace Dao;

use Modelo\MovimientoCuentaCorriente;

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

    public function agregar($movimiento)
    {
        $sql = "INSERT INTO $this->tabla (fecha_hora, importe, id_cuentas_corrientes, id_eventos) VALUES (:fecha_hora, :importe, :idCuentaCorriente, :idEvento)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $fechaYhora = $movimiento->getFechaYhora();
        $importe = $movimiento->getImporte();

        $cuentaCorriente = $movimiento->getCuentaCorriente();
        $idCuentaCorriente = $cuentaCorriente->getId();

        if ($movimiento->getEventoPeaje()) {

            $eventoPeaje = $movimiento->getEventoPeaje();

            $idEvento = $eventoPeaje->getId();

        } else if ($movimiento->getEventoMulta()) {

            $eventoMulta = $movimiento->getEventoMulta();

            $idEvento = $eventoMulta->getId();

        } else {

            echo 'error';

        }

        $sentencia->bindParam("fecha_hora", $fechaYhora);
        $sentencia->bindParam("importe", $importe);
        $sentencia->bindParam("idCuentaCorriente", $idCuentaCorriente);
        $sentencia->bindParam("idEvento", $idEvento);

        $sentencia->execute();

    }

    public function traerPorId($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_movimientos =  \"$id\"";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) return $this->listado[0];
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

    public function mapear($dataSet)
    {
        $dataSet = is_array($dataSet) ? $dataSet : [];
        $this->listado = array_map(function ($p) {

            $daoCuentaCorriente = CuentaCorrienteBdDao::getInstancia();
            $daoEventoMulta = EventoMultaBdDao::getInstancia();
            $daoEventoPeaje = EventoPeajeBdDao::getInstancia();

            $mcc = new MovimientoCuentaCorriente($p['fecha_hora'], $p['importe'], $daoCuentaCorriente->traerPorId($p['id_cuentas_corrientes']));

            $mcc->setId($p['id_movimientos']);



            return $mcc;

        }, $dataSet);
    }
}
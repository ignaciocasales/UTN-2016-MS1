<?php

namespace Dao;

use Modelo\EventoMulta;
use Modelo\EventoPeaje;
use Modelo\MovimientoCuentaCorriente;

class MovimientoBdDao implements MovimientoIDao
{
    protected $tabla = "movimientos";
    protected $listado;
    private static $instancia;

    public static function getInstancia()
    {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    private function __construct()
    {
    }

    public function agregar(MovimientoCuentaCorriente $movimiento)
    {
        /** @noinspection SqlResolve */
        $sql = "INSERT INTO $this->tabla (fehchaHora, importe, idCuentaCorriente, idEvento) 
                VALUES (:fecha_hora, :importe, :idCuentaCorriente, :idEvento)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $fechaYhora = $movimiento->getFechaYhora();
        $importe = $movimiento->getImporte();

        $cuentaCorriente = $movimiento->getCuentaCorriente();
        $idCuentaCorriente = $cuentaCorriente->getId();

        if ($movimiento->getEventoPeaje()) {
            /** @var EventoPeaje $eventoPeaje */
            $eventoPeaje = $movimiento->getEventoPeaje();

            $idEvento = $eventoPeaje->getId();
        } elseif ($movimiento->getEventoMulta()) {
            /** @var EventoMulta $eventoMulta */
            $eventoMulta = $movimiento->getEventoMulta();

            $idEvento = $eventoMulta->getId();
        } else {
            throw new \Exception('Se produjo un error');
        }

        $sentencia->bindParam("fecha_hora", $fechaYhora);
        $sentencia->bindParam("importe", $importe);
        $sentencia->bindParam("idCuentaCorriente", $idCuentaCorriente);
        $sentencia->bindParam("idEvento", $idEvento);

        $sentencia->execute();

        return $conexion->lastInsertId();
    }

    public function traerPorId($id)
    {
        /** @noinspection SqlResolve */
        $sql = "SELECT * FROM $this->tabla WHERE idMovimiento =  \"$id\" LIMIT 1";

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

    public function traerTodoPorIdCuentaCorriente($idCC)
    {
        /** @noinspection SqlResolve */
        $sql = "SELECT * FROM $this->tabla WHERE idCuentaCorriente =  \"$idCC\"";

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

    public function traerTodo()
    {
        $sql = "SELECT * FROM $this->tabla";
        $sentencia = Conexion::conectar()->prepare($sql);

        $sentencia->execute();

        $dataSet = $sentencia->fetchAll(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado)) {
            return $this->listado;
        }
        return null;
    }

    public function mapear($dataSet)
    {
        $dataSet = is_array($dataSet) ? $dataSet : [];
        $this->listado = array_map(function ($p) {

            $daoCuentaCorriente = CuentaCorrienteBdDao::getInstancia();

            $daoEventoMulta = EventoMultaBdDao::getInstancia();
            $eventoMulta = $daoEventoMulta->traerPorId($p['idEvento']);

            $daoEventoPeaje = EventoPeajeBdDao::getInstancia();
            $eventoPeaje = $daoEventoPeaje->traerPorId($p['idEvento']);

            $mcc = new MovimientoCuentaCorriente(
                $p['fechaHora'],
                $p['importe'],
                $daoCuentaCorriente->traerPorId($p['idCuentaCorriente'])
            );

            $mcc->setId($p['idMovimiento']);

            if ($eventoMulta) {
                $mcc->setEventoMulta($eventoMulta);
            } elseif ($eventoPeaje) {
                $mcc->setEventoPeaje($eventoPeaje);
            } else {
                throw new \Exception('Se produjo un error !');
            }

            return $mcc;
        }, $dataSet);
    }
}

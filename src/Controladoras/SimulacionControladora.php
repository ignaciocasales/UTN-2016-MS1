<?php


namespace Controladoras;


use Dao\CuentaCorrienteBdDao;
use Dao\EventoMultaBdDao;
use Dao\EventoPeajeBdDao;
use Dao\MovimientoCuentaCorrienteBdDao;
use Dao\SensorPeajeBdDao;
use Dao\SensorSemaforoBdDao;
use Dao\TarifaBdDao;
use Dao\UsuarioBdDao;
use Dao\VehiculoBdDao;
use Modelo\EventoMulta;
use Modelo\EventoPeaje;
use Modelo\MovimientoCuentaCorriente;

class SimulacionControladora
{
    public function __construct()
    {
    }

    public function simular()
    {

        if ($_SESSION['rol'] === 'developer') {
            $dao = VehiculoBdDao::getInstancia();
            $listado = $dao->traerTodo();
            include("../Vistas/simulacion.php");
        } else {
            echo 'no tiene permisos';
        }


    }

    public function verificar($patente, $eventoFecha, $eventoTipo)
    {
        $daoVehiculo = VehiculoBdDao::getInstancia();
        $vehiculo = $daoVehiculo->traerPorDominio($patente);

        $daoCuentaCorriente = CuentaCorrienteBdDao::getInstancia();
        $cuentaCorriente = $daoCuentaCorriente->traerPorId($vehiculo->getId());

        $daoTarifa = TarifaBdDao::getInstancia();
        $tarifa = $daoTarifa->traerPorFecha($eventoFecha);

        if ($eventoTipo === 'multa') {

            $evento = new EventoMulta($eventoFecha);

            $daoSensor = SensorSemaforoBdDao::getInstancia();
            $sensor = $daoSensor->traerCualquiera();

            $evento->setSensorSemaforo($sensor);

            $daoEvento = EventoMultaBdDao::getInstancia();
            $evento->setId($daoEvento->agregar($evento));

            $movimientoCuentaCorriente = new MovimientoCuentaCorriente($eventoFecha, $tarifa->getMulta(), $cuentaCorriente);
            $movimientoCuentaCorriente->setEventoMulta($evento);

        } else if ($eventoTipo === 'peaje') {

            $evento = new EventoPeaje($eventoFecha);

            $daoSensor = SensorPeajeBdDao::getInstancia();
            $sensor = $daoSensor->traerCualquiera();

            $evento->setSensorPeaje($sensor);

            $daoEvento = EventoPeajeBdDao::getInstancia();
            $evento->setId($daoEvento->agregar($evento));

            $movimientoCuentaCorriente = new MovimientoCuentaCorriente($eventoFecha, $tarifa->getPeajeHorasPico(), $cuentaCorriente);
            $movimientoCuentaCorriente->setEventoPeaje($evento);

        } else {

            echo 'error';

        }

        $daoMovimientoCuentaCorriente = MovimientoCuentaCorrienteBdDao::getInstancia();
        $daoMovimientoCuentaCorriente->agregar($movimientoCuentaCorriente);

        $titular = $vehiculo->getTitular();

        include("../Vistas/simulacionResultado.php");
    }
}
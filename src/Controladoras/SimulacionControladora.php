<?php


namespace Controladoras;


use Dao\CuentaCorrienteBdDao;
use Dao\EventoMultaBdDao;
use Dao\EventoPeajeBdDao;
use Dao\MovimientoCuentaCorrienteBdDao;
use Dao\SensorPeajeBdDao;
use Dao\SensorSemaforoBdDao;
use Dao\TarifaBdDao;
use Dao\VehiculoBdDao;
use Modelo\EventoMulta;
use Modelo\EventoPeaje;
use Modelo\MovimientoCuentaCorriente;

class SimulacionControladora
{
    private $daoVehiculo;
    private $daoCuentaCorriente;
    private $daoTarifa;
    private $daoSensorSemaforo;
    private $daoEventoMulta;
    private $daoSensorPeaje;
    private $daoEventoPeaje;
    private $daoMovimientoCuentaCorriente;

    public function __construct()
    {
        $this->daoMovimientoCuentaCorriente = MovimientoCuentaCorrienteBdDao::getInstancia();
        $this->daoEventoPeaje = EventoPeajeBdDao::getInstancia();
        $this->daoSensorPeaje = SensorPeajeBdDao::getInstancia();
        $this->daoEventoMulta = EventoMultaBdDao::getInstancia();
        $this->daoSensorSemaforo = SensorSemaforoBdDao::getInstancia();
        $this->daoTarifa = TarifaBdDao::getInstancia();
        $this->daoCuentaCorriente = CuentaCorrienteBdDao::getInstancia();
        $this->daoVehiculo = VehiculoBdDao::getInstancia();
    }

    public function simular()
    {

        if ($_SESSION['rol'] === 'developer') {

            $daoV = $this->daoVehiculo;

            $listado = $daoV->traerTodo();

            require("../Vistas/simulacion.php");

        } else {

            $mensaje = new Mensaje('danger', 'No tiene los permisos necesarios !');

        }


    }

    public function verificar($patente, $eventoFecha, $eventoTipo)
    {
        $daoV = $this->daoVehiculo;
        $vehiculo = $daoV->traerPorDominio($patente);

        $daoCC = $this->daoCuentaCorriente;
        $cuentaCorriente = $daoCC->traerPorId($vehiculo->getId());

        $daoTarifa = $this->daoTarifa;
        $tarifa = $daoTarifa->traerPorFecha($eventoFecha);

        if ($eventoTipo === 'multa') {

            $daoSensor = $this->daoSensorSemaforo;
            $sensor = $daoSensor->traerCualquiera();

            $evento = new EventoMulta($eventoFecha, $sensor);

            $evento->setSensorSemaforo($sensor);

            $daoEvento = $this->daoEventoMulta;
            $evento->setId($daoEvento->agregar($evento));

            $cuentaCorriente->setSaldo($cuentaCorriente->getSaldo() - $tarifa->getMulta());
            $cuentaCorriente->setFechaUltimaActualizacion($eventoFecha);
            $daoCC->actualizar($cuentaCorriente);

            $movimientoCuentaCorriente = new MovimientoCuentaCorriente($eventoFecha, $tarifa->getMulta(), $cuentaCorriente);
            $movimientoCuentaCorriente->setEventoMulta($evento);

        } else if ($eventoTipo === 'peaje') {

            $daoSensor = $this->daoSensorPeaje;
            $sensor = $daoSensor->traerCualquiera();

            $evento = new EventoPeaje($eventoFecha, $sensor);

            $evento->setSensorPeaje($sensor);

            $daoEvento = $this->daoEventoPeaje;
            $evento->setId($daoEvento->agregar($evento));

            $importe = $this->isHoraPico($eventoFecha, $tarifa);

            $cuentaCorriente->setSaldo($cuentaCorriente->getSaldo() - $importe);
            $cuentaCorriente->setFechaUltimaActualizacion($eventoFecha);
            $daoCC->actualizar($cuentaCorriente);

            $movimientoCuentaCorriente = new MovimientoCuentaCorriente($eventoFecha, $importe, $cuentaCorriente);
            $movimientoCuentaCorriente->setEventoPeaje($evento);

        } else {

            $mensaje = new Mensaje('danger', 'Se Produjo un ERROR.');

        }

        $daoMovimientoCuentaCorriente = $this->daoMovimientoCuentaCorriente;
        $daoMovimientoCuentaCorriente->agregar($movimientoCuentaCorriente);

        $titular = $vehiculo->getTitular();

        $mensaje = new Mensaje('success', 'Se genero un evento ! ');

        require("../Vistas/login.php");
    }

    public function isHoraPico($hora, $tarifa)
    {
        $horaPicoManianaDesde = strtotime('07:00:00');
        $horaPicoManianaHasta = strtotime('10:00:00');
        $horaPicoTardeDesde = strtotime('17:00:00');
        $horaPicoTardeHasta = strtotime('20:00:00');

        $h = strtotime(date('H:i:s', $hora));

        if (($h >= $horaPicoManianaDesde && $h <= $horaPicoManianaHasta) || ($h >= $horaPicoTardeDesde && $h <= $horaPicoTardeHasta)) {

            $importe = $tarifa->getPeajeHorasPico();

        } else {

            $importe = $tarifa->getPeajeHorasNormal();

        }

        return $importe;
    }
}
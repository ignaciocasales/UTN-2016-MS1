<?php


namespace Controladoras;


use Dao\CuentaCorrienteBdDao;
use Dao\CuentaCorrienteJsonDao;
use Dao\EventoMultaBdDao;
use Dao\EventoPeajeBdDao;
use Dao\EventoPeajeJsonDao;
use Dao\MovimientoCuentaCorrienteBdDao;
use Dao\MovimientoCuentaCorrienteJsonDao;
use Dao\SensorPeajeBdDao;
use Dao\SensorPeajeJsonDao;
use Dao\SensorSemaforoBdDao;
use Dao\SensorSemaforoJsonDao;
use Dao\TarifaBdDao;
use Dao\TarifaJsonDao;
use Dao\VehiculoBdDao;
use Dao\VehiculoJsonDao;
use Modelo\CuentaCorriente;
use Modelo\EventoMulta;
use Modelo\EventoPeaje;
use Modelo\Mensaje;
use Modelo\MovimientoCuentaCorriente;
use Modelo\Tarifa;
use Modelo\Vehiculo;

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
        /*
         * Los Json DAO no fueron implementados, pero en caso de habelo sido,
         * con descomentar las líneas de abajo hubiera debido el programa de
         * funcionar correctamente.
         */
        $this->daoMovimientoCuentaCorriente = MovimientoCuentaCorrienteBdDao::getInstancia();
        //$this->daoMovimientoCuentaCorriente = MovimientoCuentaCorrienteJsonDao::getInstancia();

        $this->daoEventoPeaje = EventoPeajeBdDao::getInstancia();
        //$this->daoEventoPeaje = EventoPeajeJsonDao::getInstancia();

        $this->daoSensorPeaje = SensorPeajeBdDao::getInstancia();
        //$this->daoSensorPeaje = SensorPeajeJsonDao::getInstancia();

        $this->daoEventoMulta = EventoMultaBdDao::getInstancia();
        //$this->daoEventoMulta = EventoPeajeJsonDao::getInstancia();

        $this->daoSensorSemaforo = SensorSemaforoBdDao::getInstancia();
        //$this->daoSensorSemaforo = SensorSemaforoJsonDao::getInstancia();

        $this->daoTarifa = TarifaBdDao::getInstancia();
        //$this->daoTarifa = TarifaJsonDao::getInstancia();

        $this->daoCuentaCorriente = CuentaCorrienteBdDao::getInstancia();
        //$this->daoCuentaCorriente = CuentaCorrienteJsonDao::getInstancia();

        $this->daoVehiculo = VehiculoBdDao::getInstancia();
        //$this->daoVehiculo = VehiculoJsonDao::getInstancia();
    }

    public function simular()
    {

        if ($_SESSION['rol'] === 'developer' || $_SESSION["rol"] === 'empleado') {
            $daoV = $this->daoVehiculo;

            /** @noinspection PhpUnusedLocalVariableInspection */
            $listado = $daoV->traerTodo();

            require("../Vistas/simulacion.php");
        } else {
            /** @noinspection PhpUnusedLocalVariableInspection */
            $mensaje = new Mensaje('danger', 'No tiene los permisos necesarios !');
            require("../Vistas/login.php");
        }
    }

    public function verificar($patente, $eventoFecha, $eventoTipo)
    {
        try {
            $daoV = $this->daoVehiculo;
            /** @var Vehiculo $vehiculo */
            $vehiculo = $daoV->traerPorDominio($patente);

            $daoCC = $this->daoCuentaCorriente;
            /** @var CuentaCorriente $cuentaCorriente */
            $cuentaCorriente = $daoCC->traerPorId($vehiculo->getId());

            $daoTarifa = $this->daoTarifa;
            /** @var Tarifa $tarifa */
            $tarifa = $daoTarifa->traerPorFecha($eventoFecha);

            $movimientoCuentaCorriente = new MovimientoCuentaCorriente($eventoFecha, 0, $cuentaCorriente);
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

                $movimientoCuentaCorriente->setImporte($tarifa->getMulta());
                $movimientoCuentaCorriente->setEventoMulta($evento);
            } elseif ($eventoTipo === 'peaje') {
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

                $movimientoCuentaCorriente->setImporte($importe);
                $movimientoCuentaCorriente->setEventoPeaje($evento);
            } else {
                throw new \Exception('Error al generar el evento');
            }

            $daoMovimientoCuentaCorriente = $this->daoMovimientoCuentaCorriente;
            $daoMovimientoCuentaCorriente->agregar($movimientoCuentaCorriente);

            /** @noinspection PhpUnusedLocalVariableInspection */
            $titular = $vehiculo->getTitular();

            /** @noinspection PhpUnusedLocalVariableInspection */
            $mensaje = new Mensaje('success', 'Se genero un evento ! ');

            require("../Vistas/login.php");
        } catch (\Exception $e) {
            /** @noinspection PhpUnusedLocalVariableInspection */
            $mensaje = new Mensaje('danger', $e->getMessage());

            require("../Vistas/login.php");
        }
    }

    public function isHoraPico($hora, Tarifa $tarifa)
    {
        $horaPicoManianaDesde = strtotime('07:00:00');
        $horaPicoManianaHasta = strtotime('10:00:00');
        $horaPicoTardeDesde = strtotime('17:00:00');
        $horaPicoTardeHasta = strtotime('20:00:00');

        $h = strtotime(date('H:i:s', strtotime($hora)));

        if (($h >= $horaPicoManianaDesde && $h <= $horaPicoManianaHasta)
            || ($h >= $horaPicoTardeDesde && $h <= $horaPicoTardeHasta)
        ) {
            $importe = $tarifa->getPeajeHorasPico();
        } else {
            $importe = $tarifa->getPeajeHorasNormal();
        }

        return $importe;
    }
}

<?php

namespace Controladoras;

use Dao\CuentaCorrienteBdDao;
use Dao\MovimientoBdDao;
use Dao\SensorPeajeBdDao;
use Dao\SensorSemaforoBdDao;
use Dao\TarifaBdDao;
use Dao\TitularBdDao;
use Dao\UsuarioBdDao;
use Dao\VehiculoBdDao;
use Modelo\CuentaCorriente;
use Modelo\Googlemaps;
use Modelo\Mensaje;
use Modelo\Titular;
use Modelo\Usuario;
use Modelo\Vehiculo;

class ConsultaControladora
{
    //daos
    private $daoUsuario;
    private $daoVehiculo;
    private $daoTitular;
    private $daoCuentaCorriente;
    private $daoSensorPeaje;
    private $daoSensorMulta;
    private $daoMovimientoCuentaCorriente;
    private $daoTarifas;

    private $mensaje;
    private $listado;

    public function __construct()
    {
        /*
         * Los Json DAO no fueron implementados, pero en caso de habelo sido,
         * con descomentar las líneas de abajo hubiera debido el programa de
         * funcionar correctamente.
         */
        $this->daoVehiculo = VehiculoBdDao::getInstancia();
        //$this->daoVehiculo = VehiculoJsonDao::getInstancia();

        $this->daoTitular = TitularBdDao::getInstancia();
        //$this->daoTitular = TitularJsonDao::getInstancia();

        $this->daoUsuario = UsuarioBdDao::getInstancia();
        //$this->daoUsuario = UsuarioJsonDao::getInstancia();

        $this->daoCuentaCorriente = CuentaCorrienteBdDao::getInstancia();
        //$this->daoCuentaCorriente = CuentaCorrienteJsonDao::getInstancia();

        $this->daoSensorPeaje = SensorPeajeBdDao::getInstancia();
        //$this->daoSensorPeaje = SensorPeajeJsonDao::getInstancia();

        $this->daoSensorMulta = SensorSemaforoBdDao::getInstancia();
        //$this->daoSensorMulta = SensorSemaforoJsonDao::getInstancia();

        $this->daoMovimientoCuentaCorriente = MovimientoBdDao::getInstancia();
        //$this->daoMovimientoCuentaCorriente = MovimientoCuentaCorrienteJsonDao::getInstancia();

        $this->daoTarifas = TarifaBdDao::getInstancia();
        //$this->daoTarifas = TarifaJsonDao::getInstancia();
    }

    public function usuarios()
    {
        if ($_SESSION["rol"] === 'developer') {
            $daoU = $this->daoUsuario;

            $this->listado = $daoU->traerTodo();

            require("../Vistas/consultaUsuarios.php");
        } else {
            $this->mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");
        }
    }

    public function vehiculo()
    {
        if ($_SESSION["rol"] === 'titular') {
            $daoV = $this->daoVehiculo;
            $daoT = $this->daoTitular;

            $daoU = $this->daoUsuario;

            /** @var Usuario $usuario */
            $usuario = $daoU->traerPorMail($_SESSION['mail']);

            /** @var Titular $titular */
            $titular = $daoT->traerPorIdUsuario($usuario->getId());

            $listadoVehiculos = $daoV->traerTodo();

            $this->listado = [];

            /** @var Vehiculo $vehiculo */
            foreach ($listadoVehiculos as $vehiculo) {
                /** @var Titular $t */
                $t = $vehiculo->getTitular();

                if ($t->getId() === $titular->getId()) {
                    $this->listado[] = $vehiculo;
                }
            }
            require("../Vistas/consultaVehiculos.php");
        } else {
            $this->vehiculos();
        }
    }

    public function vehiculos()
    {
        try {
            if ($_SESSION["rol"] === 'developer') {
                $daoV = $this->daoVehiculo;

                $this->listado = $daoV->traerTodo();

                if (!$this->listado) {
                    throw new \Exception('No hay vehiculos almacenados !');
                }

                require("../Vistas/consultaVehiculos.php");
            } else {
                throw new \Exception('No posee los permisos necesarios !');
            }
        } catch (\Exception $e) {
            $this->mensaje = new Mensaje('danger', $e->getMessage());
            require("../Vistas/login.php");
        }
    }

    public function detalleVehiculo($id)
    {
        $daoV = $this->daoVehiculo;

        /** @noinspection PhpUnusedLocalVariableInspection */
        $vehiculo = $daoV->traerPorId($id);

        require("../Vistas/vehiculoDetalle.php");
    }

    public function movimientos($idVehiculo)
    {
        if ($_SESSION["rol"] === 'titular') {
            $daoV = $this->daoVehiculo;
            /** @var Vehiculo $vehiculo */
            $vehiculo = $daoV->traerPorId($idVehiculo);

            $daoCC = $this->daoCuentaCorriente;
            /** @var CuentaCorriente $cuentaCorriente */
            $cuentaCorriente = $daoCC->traerPorVehiculo($vehiculo->getId());

            $daoMCC = $this->daoMovimientoCuentaCorriente;
            $listadoMovimientos = $daoMCC->traerTodoPorIdCuentaCorriente($cuentaCorriente->getId());

            if (!$listadoMovimientos) {
                $this->mensaje = new Mensaje('warning', 'No se registraron movimientos !');
            }

            require("../Vistas/consultaMovimientos.php");
        } else {
            $this->mensaje = new Mensaje('danger', 'No tiene permisos !');

            require("../Vistas/login.php");
        }
    }

    public function googlemaps($id)
    {
        if ($_SESSION["rol"] === 'developer') {
            $maps = new Googlemaps();

            /** @noinspection PhpUnusedLocalVariableInspection */
            $obtener = $maps->extraerLatitudLongitud($id);

            require("../Vistas/mapsSensor.php");
        } else {
            $this->mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");
        }
    }

    public function sensoresMulta()
    {
        if ($_SESSION["rol"] === 'developer') {
            $daoSensorM = $this->daoSensorMulta;

            $this->listado = $daoSensorM->traerTodo();

            /** @noinspection PhpUnusedLocalVariableInspection */
            $tipo = 'multa';

            require("../Vistas/consultaSensores.php");
        } else {
            $this->mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");
        }
    }

    public function sensoresPeaje()
    {
        if ($_SESSION["rol"] === 'developer') {
            $daoSensorP = $this->daoSensorPeaje;

            $this->listado = $daoSensorP->traerTodo();

            /** @noinspection PhpUnusedLocalVariableInspection */
            $tipo = 'peaje';

            require("../Vistas/consultaSensores.php");
        } else {
            $this->mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");
        }
    }

    public function tarifas()
    {
        if ($_SESSION["rol"] === 'developer' || $_SESSION["rol"] === 'empleado') {
            $daoTariffa = $this->daoTarifas;

            $this->listado = $daoTariffa->traeTodo();

            require("../Vistas/consultaTarifas.php");
        } else {
            $this->mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");
        }
    }
}

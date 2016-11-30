<?php

namespace Controladoras;

use Dao\CuentaCorrienteBdDao;
use Dao\MovimientoCuentaCorrienteBdDao;
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
    private $daoUsuario;
    private $daoVehiculo;
    private $daoTitular;
    private $daoCuentaCorriente;
    private $daoSensorPeaje;
    private $daoSensorMulta;
    private $daoMovimientoCuentaCorriente;
    private $daoTarifas;

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

        $this->daoMovimientoCuentaCorriente = MovimientoCuentaCorrienteBdDao::getInstancia();
        //$this->daoMovimientoCuentaCorriente = MovimientoCuentaCorrienteJsonDao::getInstancia();

        $this->daoTarifas = TarifaBdDao::getInstancia();
        //$this->daoTarifas = TarifaJsonDao::getInstancia();
    }

    public function todosUsuarios()
    {
        if ($_SESSION["rol"] === 'developer') {
            $daoU = $this->daoUsuario;

            /** @noinspection PhpUnusedLocalVariableInspection */
            $listado = $daoU->traerTodo();

            require("../Vistas/consultaUsuarios.php");
        } else {
            /** @noinspection PhpUnusedLocalVariableInspection */
            $mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");
        }
    }

    public function usuarioVehiculos()
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

            $listado = [];

            /** @var Vehiculo $vehiculo */
            foreach ($listadoVehiculos as $vehiculo) {
                /** @var Titular $t */
                $t = $vehiculo->getTitular();

                if ($t->getId() === $titular->getId()) {
                    $listado[] = $vehiculo;
                }
            }
            require("../Vistas/consultaVehiculos.php");
        } else {
            $this->todosVehiculos();
        }
    }

    public function todosVehiculos()
    {
        try {
            if ($_SESSION["rol"] === 'developer') {
                $daoV = $this->daoVehiculo;

                /** @noinspection PhpUnusedLocalVariableInspection */
                $listado = $daoV->traerTodo();

                if (!$listado) {
                    throw new \Exception('No hay vehiculos almacenados !');
                }

                require("../Vistas/consultaVehiculos.php");
            } else {
                throw new \Exception('No posee los permisos necesarios !');
            }
        } catch (\Exception $e) {
            /** @noinspection PhpUnusedLocalVariableInspection */
            $mensaje = new Mensaje('danger', $e->getMessage());

            require("../Vistas/login.php");
        }
    }

    public function vehiculo($id)
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
            $cuentaCorriente = $daoCC->traerPorId($vehiculo->getId());

            $daoMCC = $this->daoMovimientoCuentaCorriente;
            $listadoMovimientos = $daoMCC->traerTodoPorIdCuentaCorriente($cuentaCorriente->getId());

            if (!$listadoMovimientos) {
                /** @noinspection PhpUnusedLocalVariableInspection */
                $mensaje = new Mensaje('warning', 'No se registraron movimientos !');
            }

            require("../Vistas/consultaMovimientos.php");
        } else {
            /** @noinspection PhpUnusedLocalVariableInspection */
            $mensaje = new Mensaje('danger', 'No tiene permisos !');

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
            /** @noinspection PhpUnusedLocalVariableInspection */
            $mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");
        }
    }

    public function sensoresMulta()
    {
        if ($_SESSION["rol"] === 'developer') {
            $daoSensorM = $this->daoSensorMulta;

            /** @noinspection PhpUnusedLocalVariableInspection */
            $listado = $daoSensorM->traerTodo();

            /** @noinspection PhpUnusedLocalVariableInspection */
            $tipo = 'multa';

            require("../Vistas/consultaSensores.php");

        } else {
            /** @noinspection PhpUnusedLocalVariableInspection */
            $mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");
        }
    }

    public function sensoresPeaje()
    {
        if ($_SESSION["rol"] === 'developer') {
            $daoSensorP = $this->daoSensorPeaje;

            /** @noinspection PhpUnusedLocalVariableInspection */
            $listado = $daoSensorP->traerTodo();

            /** @noinspection PhpUnusedLocalVariableInspection */
            $tipo = 'peaje';

            require("../Vistas/consultaSensores.php");

        } else {
            /** @noinspection PhpUnusedLocalVariableInspection */
            $mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");
        }
    }

    public function tarifas()
    {
        if ($_SESSION["rol"] === 'developer' || $_SESSION["rol"] === 'empleado') {
            $daoTariffa = $this->daoTarifas;
            /** @noinspection PhpUnusedLocalVariableInspection */
            $listado = $daoTariffa->traeTodo();


            require("../Vistas/consultaTarifas.php");

        } else {
            /** @noinspection PhpUnusedLocalVariableInspection */
            $mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");
        }
    }
}

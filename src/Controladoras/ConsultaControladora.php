<?php

namespace Controladoras;


use Dao\CuentaCorrienteBdDao;
use Dao\CuentaCorrienteJsonDao;
use Dao\MovimientoCuentaCorrienteBdDao;
use Dao\MovimientoCuentaCorrienteJsonDao;
use Dao\SensorPeajeBdDao;
use Dao\SensorPeajeJsonDao;
use Dao\SensorSemaforoBdDao;
use Dao\SensorSemaforoJsonDao;
use Dao\TarifaBdDao;
use Dao\TarifaJsonDao;
use Dao\TitularBdDao;
use Dao\TitularJsonDao;
use Dao\UsuarioBdDao;
use Dao\UsuarioJsonDao;
use Dao\VehiculoBdDao;
use Dao\VehiculoJsonDao;
use Modelo\Mensaje;

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
         * Los Json DAO no fueron implementados, pero con
         * descomentar las líneas de abajo debería el programa
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

            $listado = $daoU->traerTodo();

            require("../Vistas/consultaUsuarios.php");

        } else {

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
            $usuario = $daoU->traerPorMail($_SESSION['mail']);


            $titular = $daoT->traerPorIdUsuario($usuario->getId());
            $listadoVehiculos = $daoV->traerTodo();

            $listado = [];

            foreach ($listadoVehiculos as $vehiculo) {

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
        if ($_SESSION["rol"] === 'developer') {

            $daoV = $this->daoVehiculo;

            $listado = $daoV->traerTodo();

            require("../Vistas/consultaVehiculos.php");

        } else {

            $mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");

        }
    }

    public function vehiculo($id)
    {
        $daoV = $this->daoVehiculo;

        $vehiculo = $daoV->traerPorId($id);

        require("../Vistas/vehiculoDetalle.php");
    }

    public function movimientos($idVehiculo)
    {
        if ($_SESSION["rol"] === 'titular') {

            $daoV = $this->daoVehiculo;
            $vehiculo = $daoV->traerPorId($idVehiculo);

            $daoCC = $this->daoCuentaCorriente;
            $cuentaCorriente = $daoCC->traerPorId($vehiculo->getId());

            $daoMCC = $this->daoMovimientoCuentaCorriente;
            $listadoMovimientos = $daoMCC->traerTodoPorIdCuentaCorriente($cuentaCorriente->getId());

            if (!$listadoMovimientos) {

                $mensaje = new Mensaje('warning', 'No se registraron movimientos !');

            }

            require("../Vistas/consultaMovimientos.php");

        } else {

            $mensaje = new Mensaje('danger', 'No tiene permisos !');

            require("../Vistas/login.php");

        }
    }

    public function googlemaps($id)
    {
        if ($_SESSION["rol"] === 'developer') {

            $maps = new Googlemaps();

            $obtener = $maps->extraer_latitud_longitud($id);

            require("../Vistas/mapsSensor.php");

        } else {

            $mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");

        }
    }

    public function sensoresMulta()
    {
        if ($_SESSION["rol"] === 'developer') {

            $daoSensorM = $this->daoSensorMulta;
            $listado = $daoSensorM->traerTodo();

            $tipo = 'multa';

            require("../Vistas/consultaSensores.php");

        } else {

            $mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");

        }
    }

    public function sensoresPeaje()
    {
        if ($_SESSION["rol"] === 'developer') {

            $daoSensorP = $this->daoSensorPeaje;

            $listado = $daoSensorP->traerTodo();

            $tipo = 'peaje';

            require("../Vistas/consultaSensores.php");

        } else {

            $mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");

        }
    }

    public function tarifas()
    {
        if ($_SESSION["rol"] === 'developer' || $_SESSION["rol"] === 'empleado') {

            $daoTariffa = $this->daoTarifas;
            $listado = $daoTariffa->traeTodo();


            require("../Vistas/consultaTarifas.php");

        } else {

            $mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");

        }
    }
}
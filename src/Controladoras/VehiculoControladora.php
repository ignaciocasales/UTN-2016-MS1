<?php

namespace Controladoras;

use Dao\CuentaCorrienteBdDao;
use Dao\ModeloMarcaDao;
use Dao\TitularBdDao;
use Dao\VehiculoBdDao;
use Modelo\CuentaCorriente;
use Modelo\LimpiarEntrada;
use Modelo\Mensaje;
use Modelo\QR;
use Modelo\Titular;
use Modelo\Vehiculo;

class VehiculoControladora
{
    //daos
    private $daoTitular;
    private $daoVehiculo;
    private $daoCuentaCorriente;
    private $daoMarcaModelo;

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

        $this->daoCuentaCorriente = CuentaCorrienteBdDao::getInstancia();
        //$this->daoCuentaCorriente = CuentaCorrientejsonDao::getInstancia();

        $this->daoMarcaModelo = ModeloMarcaDao::getInstancia();
    }

    /**
     * Hace lo necesarion para validar e hacer persistir un vehículo.
     *
     * @param $dni
     * @param $marcaModelo
     * @param $patente
     */
    public function alta($dni, $marcaModelo, $patente)
    {
        /*
         * El único input por el usuario en el formulario
         * de alta de vehículo es el el dominio. Entonces
         * lo valido con la función 'validarDominio'.
         */
        $dominio = $this->validarDominio($patente);

        /*
         * Si lo que me devolvió la función es válido,
         * creo el objeto y lo hago persistir.
         */
        if ($dominio) {
            /*
             * Separo el string modeloMarca en modelo y marca.
             */
            $mm = explode('|', $marcaModelo);

            $mm[0] = preg_replace('/\s+/', '', $mm[0]);
            $mm[1] = preg_replace('/\s+/', '', $mm[1]);

            /*
             * Me traigo el titular por el DNI.
             */
            $daoTitular = $this->daoTitular;

            /** @var Titular $titular */
            $titular = $daoTitular->traerPorDni($dni);

            /*
             * El qr lo guardo como un string que luego se genera
             * en un qr de formato png.
             */
            $qrContenido = 'Dominio: ' . $dominio . "\n" . 'Titular: ' .
                $titular->getNombre() . ' ' . $titular->getApellido();

            $vehiculo = new Vehiculo($dominio, $mm[0], $mm[1], $titular, $qrContenido);

            $cuentaCorriente = new CuentaCorriente(
                date('Y-m-d H:i:s', strtotime('2016-11-01 00:00:00')),
                0,
                0,
                $vehiculo
            );

            try {
                /*
                 * Hago persistir el vehículo creado y su cuenta corriente.
                 */
                $daoVehiculo = $this->daoVehiculo;

                $vehiculo->setId($daoVehiculo->agregar($vehiculo));

                $daoCC = $this->daoCuentaCorriente;

                $daoCC->agregar($cuentaCorriente);

                $qr = new QR();
                $qr->generarQR($qrContenido, $vehiculo->getDominio());

                $this->mensaje = new Mensaje('success', 'Se ha cargado el vehiculo con éxito !');

                require("../Vistas/verificarDni.php");
            } catch (\PDOException $e) {
                //1602 es el codigo para valores duplicados por una restriccion unique.
                if ($e->errorInfo[1] === 1062) {
                    $this->mensaje = new Mensaje('warning', 'Ha ingresado un dominio duplicado !');
                } else {
                    $this->mensaje = new Mensaje('danger', 'Se ha producio un error al intentar guardar el vehículo,
                 intente más tarde o con nuevos !');
                }

                require('../Vistas/verificarDni.php');
            } catch (\Exception $error) {
                $this->mensaje = new Mensaje('danger', 'Se ha producio un error !');

                require('../Vistas/verificarDni.php');
            }
        } else {
            /*
             * Si lo ingresado es erróneo, me traigo al titular por DNI
             * y lo mando de nuevo a la vista de alta de Vehículo
             * con un mensaje de alerta.
             */
            $daoTitular = $this->daoTitular;

            /** @noinspection PhpUnusedLocalVariableInspection */
            $titular = $daoTitular->traerPorDni($dni);

            $this->mensaje = new Mensaje('warning', 'Verifique los campos !');

            $daoMarcaModelo = $this->daoMarcaModelo;

            $this->listado = $daoMarcaModelo->traerTodo();

            require('../Vistas/altaVehiculo.php');
        }
    }

    /**
     * Le envio una patente desede el input y me devuelve un string
     * normalizado en caso de que esté OK, o devuelve null en caso de error.
     *
     * @param $patente
     * @return null|string
     */
    private function validarDominio($patente)
    {
        /*
         * Me instancio la clase LimpiarEntrada.
         */
        $limpiar = new LimpiarEntrada();

        /*
         * Si los campos de patente vieja estan vacíos pero no los de patente mercosur, entonces es patente mercosur.
         *
         * Si los campos de patente mercosur están vacpios pero no los de patente vieja, entonces es pantente vieja.
         *
         * Si no, devuelvo null.
         */
        if ((empty($patente[0]) || empty($patente[1]))
            && (!empty($patente[2]) || !empty($patente[3]) || !empty($patente[4]))
        ) {
            /*
             * Si los formatos estan bien, continuo.
             * Uso expresiones regulares y la funcion preg_match().
             *
             * La función clean_input() es de la clase LimpiarEntrada, y
             * me devuelve un string sin caracteres no deseados.
             *
             * Uso la funcion strtoupper(), para obtener los string de
             * las patentes en mayúsculas.
             */
            if ((preg_match("/^[a-zA-Z]+$/", $limpiar->cleanInput($patente[2])))
                && (preg_match("/^[0-9]+$/", $limpiar->cleanInput($patente[3])))
                && (preg_match("/^[a-zA-Z]+$/", $limpiar->cleanInput($patente[4])))
            ) {
                $dominio = strtoupper($limpiar->cleanInput($patente[2])) . '-' . $limpiar->cleanInput($patente[3])
                    . '-' . strtoupper($limpiar->cleanInput($patente[4]));

                return $dominio;
            }
        } elseif ((empty($patente[2]) || empty($patente[3]) || empty($patente[4]))
            && (!empty($patente[0]) || !empty($patente[1]))
        ) {
            /*
             * Si los formatos estan bien, continuo.
             * Uso expresiones regulares y la funcion preg_match().
             *
             * La función clean_input() es de la clase LimpiarEntrada, y
             * me devuelve un string sin caracteres no deseados.
             *
             * Uso la funcion strtoupper(), para obtener los string de
             * las patentes en mayúsculas.
             */
            if ((preg_match("/^[a-zA-Z]+$/", $limpiar->cleanInput($patente[0])))
                && (preg_match("/^[0-9]+$/", $limpiar->cleanInput($patente[1])))
            ) {
                $dominio = strtoupper($limpiar->cleanInput($patente[0])) . '-' . $limpiar->cleanInput($patente[1]);

                return $dominio;
            }
        }
        return null;
    }

    public function eliminar($patente)
    {
        try {
            $daoVehiculo = $this->daoVehiculo;

            $daoVehiculo->eliminarPorDominio($patente);

            $this->mensaje = new Mensaje('success', 'Se elimino el vehiculo correctamente!');
        } catch (\Exception $e) {
            $this->mensaje = new Mensaje('danger', 'No se pudo eliminar el vehiculo');
        }
        //Vuelvo a cargar la consulta...
        $consultaVehiculos = new ConsultaControladora();
        $consultaVehiculos->vehiculos();
    }

    public function modal($idVehiculo)
    {
        try {
            $daoVehiculoModal = $this->daoVehiculo;

            $this->listado = $daoVehiculoModal->traerTodo();

            /** @noinspection PhpUnusedLocalVariableInspection */
            $vehiculo = $daoVehiculoModal->traerPorId($idVehiculo);

            require("../Vistas/consultaVehiculos.php");
        } catch (\Exception $e) {
            $this->mensaje = new Mensaje('danger', 'Error inesperado, intente mas tarde');

            require('../Vistas/consultaVehiculos.php');
        }
    }

    public function registrar()
    {
        require("../Vistas/altaVehiculo.php");
    }
}

<?php

namespace Controladoras;

use Dao\TitularBdDao;
use Dao\VehiculoBdDao;
use Modelo\LimpiarEntrada;
use Modelo\Mensaje;
use Modelo\QR;
use Modelo\Titular;
use Modelo\Vehiculo;

class VehiculoControladora
{
    private $daoTitular;
    private $daoVehiculo;

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
    }

    /**
     * Hace lo necesarion para validar e hacer persistir un vehículo.
     *
     * @param $dni
     * @param $marcaModelo
     * @param $patente
     */
    public function darAltaVehiculo($dni, $marcaModelo, $patente)
    {
        /*
         * El único input por el usuario en el formulario
         * de alta de vehículo es el el dominio. Entonces
         * lo valido con una función que cree.
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

            try {
                /*
                 * Hago persistir el vehículo creado.
                 */
                $daoVehiculo = $this->daoVehiculo;

                $daoVehiculo->agregar($vehiculo);

                $qr = new QR();
                $qr->generarQR($qrContenido, $vehiculo->getDominio());

                /** @noinspection PhpUnusedLocalVariableInspection */
                $mensaje = new Mensaje('success', 'Se ha cargado el vehiculo con éxito !');

                require("../Vistas/verificarDni.php");
            } catch (\PDOException $e) {
                /** @noinspection PhpUnusedLocalVariableInspection */
                $mensaje = new Mensaje('danger', 'Se ha producio un error. 
                Posible Dominio duplicado / Campos vacíos !');

                require('../Vistas/verificarDni.php');
            } catch (\Exception $error) {

                /** @noinspection PhpUnusedLocalVariableInspection */
                $mensaje = new Mensaje('danger', 'Se ha producio un error !');

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

            /** @noinspection PhpUnusedLocalVariableInspection */
            $mensaje = new Mensaje('warning', 'Verifique los campos !');

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

            /** @noinspection PhpUnusedLocalVariableInspection */
            $listado = $daoVehiculo->traerTodo();

            /** @noinspection PhpUnusedLocalVariableInspection */
            $mensaje = new Mensaje('success', 'Se elimino el vehiculo correctamente!');

            require("../Vistas/consultaVehiculos.php");
        } catch (\Exception $e) {

            /** @noinspection PhpUnusedLocalVariableInspection */
            $mensaje = new Mensaje('danger', 'No se pudo eliminar el vehiculo');

            require('../Vistas/consultaVehiculos.php');
        }
    }

    public function eliminarModal($idVehiculo)
    {
        try {
            $daoVehiculoModal = $this->daoVehiculo;

            /** @noinspection PhpUnusedLocalVariableInspection */
            $listado = $daoVehiculoModal->traerTodo();

            /** @noinspection PhpUnusedLocalVariableInspection */
            $vehiculo = $daoVehiculoModal->traerPorId($idVehiculo);

            require("../Vistas/consultaVehiculos.php");
        } catch (\Exception $e) {
            /** @noinspection PhpUnusedLocalVariableInspection */
            $mensaje = new Mensaje('danger', 'Error inesperado, intente mas tarde');

            require('../Vistas/consultaVehiculos.php');
        }
    }

    public function registrar()
    {
        require("../Vistas/altaVehiculo.php");
    }
}

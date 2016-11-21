<?php

namespace Controladoras;


use Dao\TitularBdDao;
use Dao\VehiculoBdDao;
use Modelo\Vehiculo;

class vehiculoControladora
{
    private $daoTitular;
    private $daoVehiculo;

    function __construct()
    {
        $this->daoVehiculo = VehiculoBdDao::getInstancia();
        $this->daoTitular = TitularBdDao::getInstancia();
    }

    public function darAltaVehiculo($dni, $marcaModelo, $patente)
    {
        $dominio = $this->validarDominio($patente);

        if ($dominio) {

            $mm = explode('|', $marcaModelo);

            $mm[0] = preg_replace('/\s+/', '', $mm[0]);
            $mm[1] = preg_replace('/\s+/', '', $mm[1]);

            $daoTitular = $this->daoTitular;

            $titular = $daoTitular->traerPorDni($dni);

            $qr = 'Dominio: ' . $dominio;

            $vehiculo = new Vehiculo($dominio, $mm[0], $mm[1], $titular, $qr);

            try {
                $daoVehiculo = $this->daoVehiculo;

                $daoVehiculo->agregar($vehiculo);

                if ($daoVehiculo->traerPorDominio($vehiculo->getDominio())) {

                    $mensaje = new Mensaje('success', 'Se ha cargado el vehiculo con éxito !');

                    require("../Vistas/verificarDni.php");

                } else {

                    $mensaje = new Mensaje('danger', 'No se pudo cargar !');

                    require("../Vistas/verificarDni.php");

                }


            } catch (\Exception $error) {

                $mensaje = new Mensaje('danger', 'Se ha producio un error. Posible Dominio duplicado / Campos vacíos !');

                require('../Vistas/verificarDni.php');

            }

        } else {

            $mensaje = new Mensaje('danger', 'Ha ingresado un dominio erróneo !');

            require('../Vistas/verificarDni.php');
        }
    }

    private function validarDominio($patente)
    {
        $limpiar = new LimpiarEntrada();

        if (empty($patente[0]) || empty($patente[1])) {

            $dominio = strtoupper($limpiar->clean_input($patente[2])) . '-' . $limpiar->clean_input($patente[3]) . '-' . strtoupper($limpiar->clean_input($patente[4]));

            return $dominio;

        } else if (empty($patente[2]) || empty($patente[3]) || empty($patente[4])) {

            $dominio = strtoupper($limpiar->clean_input($patente[0])) . '-' . $limpiar->clean_input($patente[1]);

            return $dominio;

        }

        return null;
    }

    public function eliminar($patente)
    {

        try {

            $daoVehiculo = $this->daoVehiculo;

            $daoVehiculo->eliminarPorDominio($patente);

            $listado = $daoVehiculo->traerTodo();

            $mensaje = new Mensaje('success', 'Se elimino el vehiculo correctamente!');

            require("../Vistas/consultaVehiculos.php");

        } catch (\Exception $e) {

            $mensaje = new Mensaje('danger', 'No se pudo eliminar el vehiculo');

            require('../Vistas/consultaVehiculos.php');
        }
    }

    public function eliminarModal($idVehiculo)
    {
        try {

            $daoVehiculoModal = $this->daoVehiculo;

            $listado = $daoVehiculoModal->traerTodo();

            $vehiculo = $daoVehiculoModal->traerPorId($idVehiculo);

            require("../Vistas/consultaVehiculos.php");

        } catch (\Exception $e) {

            $mensaje = new Mensaje('danger', 'Error inesperado, intente mas tarde');

            require('../Vistas/consultaVehiculos.php');

        }
    }

    public function registrar()
    {
        require("../Vistas/altaVehiculo.php");
    }
}
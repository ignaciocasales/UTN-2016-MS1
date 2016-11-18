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

    public function darAltaVehiculo($dni, $patente, $marca, $modelo)
    {
        $daoTitular = $this->daoTitular;

        $titular = $daoTitular->traerPorDni($dni);

        $qr = 'Dominio: ' . $patente;

        $vehiculo = new Vehiculo($patente, $marca, $modelo, $titular, $qr);

        try {
            $daoVehiculo = $this->daoVehiculo;

            $daoVehiculo->agregar($vehiculo);

            if ($daoVehiculo->traerPorDominio($vehiculo->getDominio())) {

                $nombre = 'vehiculo';

                require("../Vistas/verificarDni.php");

            } else {

                $mensaje = new Mensaje('danger', 'No se pudo cargar !');

                require("../Vistas/verificarDni.php");

            }


        } catch (\Exception $error) {

            $mensaje = new Mensaje('danger', 'Error inesperado, intente mas tarde');

            require('../Vistas/consultaVehiculos.php');

        }
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
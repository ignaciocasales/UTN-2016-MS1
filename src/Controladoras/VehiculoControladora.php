<?php

namespace Controladoras;


use Dao\TitularBdDao;
use Dao\VehiculoBdDao;
use Modelo\Vehiculo;

class vehiculoControladora
{
    function __construct()
    {
    }

    public function darAltaVehiculo($dni, $patente, $marca, $modelo)
    {
        $daoTitular = TitularBdDao::getInstancia();

        $titular = $daoTitular->traerPorDni($dni);

        $vehiculo = new Vehiculo($patente, $marca, $modelo, $titular);

        try {
            $daoVehiculo = VehiculoBdDao::getInstancia();

            $daoVehiculo->agregar($vehiculo);

            if ($daoVehiculo->traerPorDominio($vehiculo->getDominio())) {

                $nombre = 'titular';

                include("../Vistas/registroExitoso.php");

            } else {

                echo 'no se cargo';

            }


        } catch (\Exception $error) {
            echo 'Hubo un error al procesar los datos. Error:' . $error;
        }
    }

    public function registrar()
    {
        include("../Vistas/altaVehiculo.php");
    }
}
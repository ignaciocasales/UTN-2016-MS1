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

    public function darAltaVehiculo($patente, $marca, $modelo, $dni)
    {

        $titular = TitularBdDao::getInstancia()->traerPorDni($dni);
        $vehiculo = new Vehiculo($patente, $marca, $modelo, $titular);


        try {
            VehiculoBdDao::getInstancia()->agregar($vehiculo);
            $nombre = "vehiculo";

            include("../Vistas/registroExitoso.php");

        } catch (\Exception $error) {
            echo 'Hubo un error al procesar los datos. Error:' . $error;
        }
    }

    public function registrar()
    {
        include("../Vistas/abmVehiculos.php");
    }
}
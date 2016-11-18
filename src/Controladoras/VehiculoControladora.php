<?php

namespace Controladoras;


use Dao\TitularBdDao;
use Dao\VehiculoBdDao;
use Modelo\Vehiculo;

class vehiculoControladora
{
    private $dao_titular;

    function __construct()
    {
        $this->dao_titular = TitularBdDao::getInstancia();
    }

    public function darAltaVehiculo($dni, $patente, $marca, $modelo)
    {
        $daoTitular = $this->dao_titular;

        $titular = $daoTitular->traerPorDni($dni);

        $vehiculo = new Vehiculo($patente, $marca, $modelo, $titular);

        try {
            $daoVehiculo = VehiculoBdDao::getInstancia();

            $daoVehiculo->agregar($vehiculo);

            if ($daoVehiculo->traerPorDominio($vehiculo->getDominio())) {

                $nombre = 'vehiculo';

                include("../Vistas/registroExitoso.php");

            } else {

                echo 'no se cargo';

            }


        } catch (\Exception $error) {
            echo 'Hubo un error al procesar los datos. Error:' . $error;
        }
    }

    public function eliminar($patente){
        try{
            $daoVehiculo = VehiculoBdDao::getInstancia();
            $daoVehiculo->eliminarPorDominio($patente);
            $listado = $daoVehiculo->traerTodo();
            $mensaje = new Mensaje('success','Se elimino el vehiculo correctamente!');
            require ("../Vistas/consultaVehiculos.php");
        }catch (\Exception $e){
            new Mensaje('danger','No se pudo eliminar el vehiculo');
            require ('../Vistas/consultaVehiculos.php');
        }

    }
    public function eliminarModal($idVehiculo){
        try{
            $daoVehiculoModal = VehiculoBdDao::getInstancia();
            $listado = $daoVehiculoModal->traerTodo();
            $vehiculo = $daoVehiculoModal->traerPorId($idVehiculo);
            require ("../Vistas/consultaVehiculos.php");
        }catch(\Exception $e){
            $mensaje = new Mensaje('danger','Error inesperado, intente mas tarde');
            require ('../Vistas/consultaVehiculos.php');
        }


    }
    public function registrar()
    {
        include("../Vistas/altaVehiculo.php");
    }
}
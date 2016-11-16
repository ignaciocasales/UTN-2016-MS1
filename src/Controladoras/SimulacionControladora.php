<?php


namespace Controladoras;


use Dao\CuentaCorrienteBdDao;
use Dao\MovimientoCuentaCorrienteBdDao;
use Dao\TarifaBdDao;
use Dao\UsuarioBdDao;
use Dao\VehiculoBdDao;
use Modelo\EventoMulta;
use Modelo\EventoPeaje;
use Modelo\MovimientoCuentaCorriente;

class SimulacionControladora
{
    public function __construct()
    {
    }

    public function simular()
    {

        if ($_SESSION['rol'] === 'developer') {
            $dao = VehiculoBdDao::getInstancia();
            $listado = $dao->traerTodo();
            include("../Vistas/simulacion.php");
        } else {
            echo 'no tiene permisos';
        }


    }

    public function verificar($patente, $eventoFecha, $evento)
    {
        echo '<pre>';
        $daoVehiculo = VehiculoBdDao::getInstancia();
        $vehiculo = $daoVehiculo->traerPorDominio($patente);
        print_r($vehiculo);
        $daoCuentaCorriente = CuentaCorrienteBdDao::getInstancia();
        $cuentaCorriente = $daoCuentaCorriente->traerPorId($vehiculo->getId());
        print_r($cuentaCorriente);
        $daoTarifa = TarifaBdDao::getInstancia();
        $tarifa = $daoTarifa->traerPorFecha($eventoFecha);
        print_r($tarifa);
        if($evento==='multa'){

            $movimientoCuentaCorriente = new MovimientoCuentaCorriente($eventoFecha,$tarifa->getMulta(),$cuentaCorriente);
            $movimientoCuentaCorriente->setEventoMulta(new EventoMulta($eventoFecha));

        }else if($evento==='peaje'){

            $movimientoCuentaCorriente = new MovimientoCuentaCorriente($eventoFecha,$tarifa->getPeajeHorasPico(),$cuentaCorriente);
            $movimientoCuentaCorriente->setEventoPeaje(new EventoPeaje($eventoFecha));

        }else{

            echo 'error';

        }
        print_r($movimientoCuentaCorriente);
        echo '</pre>';

        //$daoMovimientoCuentaCorriente = MovimientoCuentaCorrienteBdDao::getInstancia();
        //$daoMovimientoCuentaCorriente->agregar($movimientoCuentaCorriente);



        include("../Vistas/simulacionResultado.php");


    }
}
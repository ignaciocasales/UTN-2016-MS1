<?php


namespace Controladoras;


use Dao\UsuarioBdDao;
use Dao\VehiculoBdDao;

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
            include("../Vistas/vistaConsultaSimulacion.php");
        } else {
            echo 'no tiene permisos';
        }


    }

    public function verificar($patente, $evento, $eventoFecha)
    {

        $dao = VehiculoBdDao::getInstancia();
        $vehiculo = $dao->traerPorDominio($patente);
        $titular = $vehiculo->getTitular();
        $gastoPeaje = 20;
        if ($evento == 'semaforo') {

        } else {
            if (isset($eventoFecha)) {
                if($eventoFecha === '2016-11-01 07:00:00'){
                    $gastoPeaje = 25;
                }
            }
        }

        include("../Vistas/resultadoSimulacion.php");


    }
}
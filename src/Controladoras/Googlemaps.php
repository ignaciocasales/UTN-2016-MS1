<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 23/11/2016
 * Time: 10:22 AM
 */

namespace Controladoras;


use Dao\SensorPeajeBdDao;
use Dao\SensorSemaforoBdDao;

class Googlemaps
{
    private $latitud;
    private $longitud;
    private $fechaalta;
    private $numeroserie;
    private $daoPeaje;
    private $daoSemaforo;

    public function __construct()
    {

        $this->daoPeaje = SensorPeajeBdDao::getInstancia();
        //$this->daoPeaje = PeajeJsonDao::getInstancia();

        $this->daoSemaforo = SensorSemaforoBdDao::getInstancia();
        //$this->daoSemaforo = SemaforoJsonDao::getInstancia();

    }

    /**
     * @return mixed
     */
    public function getDaoPeaje()
    {
        return $this->daoPeaje;
    }
    public function extraer_latitud_longitud($id)
    {
        $daoP=$this->daoPeaje;
        $sensor= $daoP->traerPorId($id);
        $fechaalta = $sensor->getFechaAlta();
        $numeroserie = $sensor->getNumeroSerie();
        $latitud = $sensor->getLatitud();
        $longitud = $sensor->getLongitud();
        $arreglo = array(
            "latitud" => $latitud,
            "longitud" => $longitud,
             "numeroserie" => $numeroserie,
             "fechaalta" => $fechaalta
        );
        return $arreglo;

    }
}
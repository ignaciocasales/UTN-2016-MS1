<?php

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
        $daoP = $this->daoPeaje;
        $daoS = $this->daoSemaforo;

        $sensor = $daoP->traerPorId($id);
        if (!$sensor) {
            $sensor = $daoS->traerPorId($id);
            $descripcion = 'multa';
        } else {
            $descripcion = 'peaje';
        }
        $fechaalta = $sensor->getFechaAlta();
        $numeroserie = $sensor->getNumeroSerie();
        $latitud = $sensor->getLatitud();
        $longitud = $sensor->getLongitud();
        $arreglo = array(
            "latitud" => $latitud,
            "longitud" => $longitud,
            "numeroserie" => $numeroserie,
            "fechaalta" => $fechaalta,
            "descripcion" => $descripcion
        );

        return $arreglo;

    }
}
<?php

namespace Controladoras;


use Dao\TitularBdDao;
use Dao\TitularJsonDao;

class titularControladora
{
    function __construct()
    {
    }

    public function buscarDni(){
        include ("../Vistas/buscarDniTitular.php");
    }

    public
    function verificar($dni)
    {
        if (isset($dni)) {
            $existe = $this->existe($dni);
            if ($existe != null) {
                include ("../Vistas/abmVehiculos.php");
            }else{
              //  header('Location: ' . URL_PUBLIC);
                $this->registrar($dni);
            }
        }
    }

    protected function existe($dni)
    {
        $dao = TitularBdDao::getInstancia();
        //$dao = TitularJsonDao::getInstancia();

        $array = $dao->traeUno($dni);

        if (!empty($array)) {
            if ($dni === $array["dni"]) {
                return $array;
            }
        } else {
            return null;
        }
    }

    public function registrar($dni)
    {
        include("../Vistas/abmTitular.php");
    }
}
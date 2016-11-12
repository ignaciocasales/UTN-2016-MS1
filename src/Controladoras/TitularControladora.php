<?php

namespace Controladoras;


use Dao\RolBdDao;
use Dao\TitularBdDao;
use Dao\TitularJsonDao;
use Dao\UsuarioBdDao;
use Modelo\Rol;
use Modelo\Titular;
use Modelo\Usuario;

class titularControladora
{
    function __construct()
    {
    }

    public function buscarDni(){
        include ("../Vistas/buscarDniTitular.php");
    }


    public function darAltaTitular($nombre ,$apellido,$dni ,$telefono,$email,$password){

        $usuario = new Usuario($email,$password,new Rol('titular'));
        $titular = new Titular($nombre,$apellido,$dni,$telefono,$usuario);

        try{
            UsuarioBdDao::getInstancia()->agregar($usuario);
            TitularBdDao::getInstancia()->agregar($titular);

            include ("../Vistas/registroTitularExitoso.php");

        }catch(\Exception $error){
            echo 'Hubo un error al procesar los datos. Error:' . $error;
        }

    }
    public
    function verificar($dni)
    {
        if (isset($dni)) {
            $titular = $this->existe($dni);
            if ($titular != null) {
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
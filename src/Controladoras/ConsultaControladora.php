<?php

namespace Controladoras;


use Dao\TitularBdDao;
use Dao\UsuarioBdDao;
use Dao\VehiculoBdDao;

class ConsultaControladora
{
    public function todosUsuarios()
    {
        if ($_SESSION["rol"] === 'developer') {
            $dao = UsuarioBdDao::getInstancia();
            //$dao = UsuarioJsonDao::getInstancia();

            $listado = $dao->traerTodo();

            include("../Vistas/consultaUsuarios.php");
        } else {
            echo 'no tiene permisos';
        }
    }

    public function  usuarioVehiculos(){
        if($_SESSION["rol"] === 'titular'){
            $vdao = VehiculoBdDao::getInstancia();
            $tdao = TitularBdDao::getInstancia();

            $udao = UsuarioBdDao::getInstancia();
            $usuario = $udao->traerPorMail($_SESSION['mail']);


            $titular = $tdao->traerPorIdUsuario($usuario->getId());
            $listadoVehiculos = $vdao->traerTodo();

            $listado = [];

            foreach ($listadoVehiculos as $vehiculo){
                $titu = $vehiculo->getTitular();

                if($titu->getId() === $titular->getId()){
                    $listado[] = $vehiculo;
                }
            }

            include("../Vistas/consultaVehiculos.php");

        }else{
            $this->todosVehiculos();
        }
    }
    public function todosVehiculos()
    {
        if ($_SESSION["rol"] === 'developer') {
            $dao = VehiculoBdDao::getInstancia();
            //$dao = UsuarioJsonDao::getInstancia();

            $listado = $dao->traerTodo();

            include("../Vistas/consultaVehiculos.php");
        } else {
            echo 'no tiene permisos';
        }
    }
}
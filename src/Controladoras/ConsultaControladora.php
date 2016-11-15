<?php

namespace Controladoras;


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
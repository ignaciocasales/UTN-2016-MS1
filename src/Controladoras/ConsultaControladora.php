<?php

namespace Controladoras;


use Dao\TitularBdDao;
use Dao\TitularJsonDao;
use Dao\UsuarioBdDao;
use Dao\UsuarioJsonDao;
use Dao\VehiculoBdDao;
use Dao\VehiculoJsonDao;

class ConsultaControladora
{
    private $daoUsuario;

    private $daoVehiculo;

    private $daoTitular;

    public function __construct()
    {
        $this->daoVehiculo = VehiculoBdDao::getInstancia();
        //$this->daoVehiculo = VehiculoJsonDao::getInstancia();

        $this->daoTitular = TitularBdDao::getInstancia();
        //$this->daoTitular = TitularJsonDao::getInstancia();

        $this->daoUsuario = UsuarioBdDao::getInstancia();
        //$this->daoUsuario = UsuarioJsonDao::getInstancia();
    }

    public function todosUsuarios()
    {
        if ($_SESSION["rol"] === 'developer') {

            $daoU = $this->daoUsuario;

            $listado = $daoU->traerTodo();

            require("../Vistas/consultaUsuarios.php");

        } else {

            $mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");
        }
    }

    public function usuarioVehiculos()
    {
        if ($_SESSION["rol"] === 'titular') {

            $daoV = $this->daoVehiculo;
            $daoT = $this->daoTitular;

            $daoU = $this->daoUsuario;
            $usuario = $daoU->traerPorMail($_SESSION['mail']);


            $titular = $daoT->traerPorIdUsuario($usuario->getId());
            $listadoVehiculos = $daoV->traerTodo();

            $listado = [];

            foreach ($listadoVehiculos as $vehiculo) {

                $t = $vehiculo->getTitular();

                if ($t->getId() === $titular->getId()) {

                    $listado[] = $vehiculo;

                }

            }

            require("../Vistas/consultaVehiculos.php");

        } else {

            $this->todosVehiculos();

        }
    }

    public function todosVehiculos()
    {
        if ($_SESSION["rol"] === 'developer') {

            $daoV = $this->daoVehiculo;

            $listado = $daoV->traerTodo();

            require("../Vistas/consultaVehiculos.php");

        } else {

            $mensaje = new Mensaje('danger', 'No posee los permisos necesarios !');

            require("../Vistas/login.php");

        }
    }

    public function vehiculo($id)
    {
        $daoV = $this->daoVehiculo;

        $vehiculo = $daoV->traerPorId($id);

        require("../Vistas/vehiculoDetalle.php");
    }
}
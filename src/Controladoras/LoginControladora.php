<?php

namespace Controladoras;

use Dao\RolBdDao;
use Dao\RolJsonDao;
use Dao\UsuarioBdDao;
use Dao\UsuarioJsonDao;

class loginControladora
{
    public function __construct()
    {

    }

    public function index()
    {
        //Si estan seteadas las variables de sesion cargo bienvenida
        //sino cargo login
        if ((isset($_SESSION["mail"]) && $_SESSION["pwd"])) {
            require("../Vistas/bienvenida.php");
        } else {
            require("../Vistas/login.php");
        }
    }

    public function terminar()
    {
        //Al presionar 'cerrar sesión' llamo a logout
        include("../Vistas/logout.php");
    }

    public
    function verificar($mail, $pwd)
    {
        //estan seteadas mail y contraseña?
        if (isset($mail) && isset($pwd)) {

            //estan vacias?
            if ($mail === "" || $pwd === "") {

                echo "Por favor, completar usuario y clave";

            } else {

                $dao = UsuarioBdDao::getInstancia();
                //$dao = UsuarioJsonDao::getInstancia();

                $usuario = $dao->traeUno($mail);

                //existe?
                if ($this->existe($usuario)) {

                    //corresponde?
                    if ($mail === $usuario->getEmail() && $pwd === $usuario->getPassword()) {

                        //dame los privilegios.
                        $privilegios = $this->establecerPrivilegios($usuario);

                        $_SESSION["mail"] = $mail;
                        $_SESSION["pwd"] = $pwd;
                        $_SESSION["rol"] = $privilegios;

                    }
                }
            }
        }else{
            echo 'valores no seteados';
        }
        //require ('/index.php');
        header('Location: /index.php');

    }

    protected function existe($usuario)
    {
        if (!empty($usuario)) {
            if (count($usuario) === 1) {
                return true;
            }
        }

        return false;
    }

    protected function establecerPrivilegios($usuario)
    {
        $dao = RolBdDao::getInstancia();
        //$dao = RolJsonDao::getInstancia();

        $rol = $dao->traeUno($usuario->getRol());

        return $rol->getDescripcion();
    }
}
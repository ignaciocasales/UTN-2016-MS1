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
        if ((isset($_SESSION["mail"]) && $_SESSION["pwd"])) {
            include("../Vistas/bienvenida.php");
        } else {
            include("../Vistas/login.php");
        }
    }

    public function terminar()
    {
        include("../Vistas/logout.php");
    }

    public
    function verificar($mail, $pwd)
    {
        if (isset($mail) && isset($pwd)) {

            if ($mail === "" || $pwd === "") {

                echo "Por favor, completar usuario y clave";

            } else {

                $dao = UsuarioBdDao::getInstancia();
                //$dao = UsuarioJsonDao::getInstancia();

                $usuario = $dao->traeUno($mail);
                print_r($usuario);
                if ($this->existe($usuario)) {

                    if ($mail === $usuario->getEmail() && $pwd === $usuario->getPassword()) {

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

        header('Location: ' . URL_PUBLIC);

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
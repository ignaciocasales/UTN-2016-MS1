<?php

namespace Controladoras;

use Dao\RolBdDao;
use Dao\RolJsonDao;
use Dao\UsuarioBdDao;
use Dao\UsuarioJsonDao;
use Modelo\Rol;
use Modelo\Usuario;

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
        if (isset($mail) && isset($pwd)) {

            if ($mail === "" || $pwd === "") {

                echo "Por favor, completar usuario y clave";

            } else {

                $dao = UsuarioBdDao::getInstancia();
                //$dao = UsuarioJsonDao::getInstancia();

                $usuario = $dao->traerPorMail($mail);

                if ($this->existe($usuario)) {

                    if ($mail === $usuario->getEmail() && $pwd === $usuario->getPassword()) {

                        $rol = $usuario->getRol();

                        $_SESSION["mail"] = $mail;
                        $_SESSION["pwd"] = $pwd;
                        $_SESSION["rol"] = $rol->getDescripcion();

                    }
                }
            }
        } else {
            echo 'valores no seteados';
        }
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
}
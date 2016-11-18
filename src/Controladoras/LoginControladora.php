<?php

namespace Controladoras;

use Dao\RolBdDao;
use Dao\RolJsonDao;
use Dao\TitularBdDao;
use Dao\UsuarioBdDao;
use Dao\UsuarioJsonDao;
use Dao\VehiculoBdDao;
use Modelo\Rol;
use Modelo\Usuario;

class loginControladora
{
    public function __construct()
    {

    }

    public function index()
    {
        require("../Vistas/login.php");
    }

    public function terminar()
    {
        //Al presionar 'cerrar sesión' llamo a logout
        include("../Vistas/logout.php");
    }

    public
    function verificar($mail, $pwd)
    {
        try {
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
                        }else{
                            $mensaje = new Mensaje('danger', 'usuario o contraseña incorrectos');

                        }
                    }
                }
            } else {
                $mensaje = new Mensaje('danger', 'valores no seteados');
            }
        } catch (\PDOException $e) {
            $mensaje = new Mensaje('danger', 'Hubo un error al conectarse a la base de datos !');
        }

        require('../Vistas/login.php');

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
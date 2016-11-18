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

    public
    function verificar($mail, $pwd)
    {
        try {
            if (isset($mail) && isset($pwd)) {

                if ($mail === "" || $pwd === "") {

                    $mensaje = new Mensaje('warning', 'Debe llenar todos los campos !');

                } else {

                    $dao = UsuarioBdDao::getInstancia();
                    //$dao = UsuarioJsonDao::getInstancia();

                    $usuario = $dao->traerPorMail($mail);

                    if ($mail === $usuario->getEmail() && $pwd === $usuario->getPassword()) {

                        $rol = $usuario->getRol();

                        $_SESSION["mail"] = $mail;
                        $_SESSION["pwd"] = $pwd;
                        $_SESSION["rol"] = $rol->getDescripcion();

                    } else {

                        $mensaje = new Mensaje('warning', 'Datos de inicio de sesión incorrectos !');

                    }
                }
            } else {

                $mensaje = new Mensaje('danger', 'Error al iniciar sesión, intentelo más tarde !');

            }
        } catch (\PDOException $e) {

            $mensaje = new Mensaje('danger', 'Hubo un error al conectarse con la base de datos !');

        }

        require("../Vistas/login.php");
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
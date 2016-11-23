<?php

namespace Controladoras;

use Dao\RolBdDao;
use Dao\RolJsonDao;
use Dao\TitularBdDao;
use Dao\UsuarioBdDao;
use Dao\UsuarioJsonDao;
use Dao\VehiculoBdDao;
use Modelo\limpiarEntrada;
use Modelo\Mensaje;
use Modelo\Rol;
use Modelo\Usuario;

class loginControladora
{
    private $daoUsuario;

    public function __construct()
    {
        /*
         * Los Json DAO no fueron implementados, pero con
         * descomentar las líneas de abajo debería el programa
         * funcionar correctamente.
         */
        $this->daoUsuario = UsuarioBdDao::getInstancia();
        //$this->daoUsuario = UsuarioJsonDao::getInstancia();
    }

    public function index()
    {
        require("../Vistas/login.php");
    }

    public function verificar($mail, $pwd)
    {
        try {
            $limpiar = new LimpiarEntrada();

            $mail = $limpiar->clean_input($mail);

            $pwd = $limpiar->clean_input($pwd);

            if (isset($mail) && isset($pwd)) {

                if ($mail === "" || $pwd === "") {

                    $mensaje = new Mensaje('warning', 'Debe llenar todos los campos !');

                } else {

                    $daoU = $this->daoUsuario;

                    $usuario = $daoU->traerPorMail($mail);

                    if ($mail === $usuario->getEmail() && $pwd === $usuario->getPassword()) {

                        $rol = $usuario->getRol();

                        $_SESSION["mail"] = $mail;
                        $_SESSION["pwd"] = $pwd;
                        $_SESSION["rol"] = $rol->getDescripcion();

                        $mensaje = new Mensaje('success', 'Ha iniciado sesión satisfactoriamente ! Se ha logueado como' . ' ' . '<i><u>' . $usuario->getEmail() . '</i></u>');

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
}
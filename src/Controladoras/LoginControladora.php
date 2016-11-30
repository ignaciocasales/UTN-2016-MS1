<?php

namespace Controladoras;

use Dao\RolBdDao;
use Dao\RolJsonDao;
use Dao\TitularBdDao;
use Dao\UsuarioBdDao;
use Dao\UsuarioJsonDao;
use Dao\VehiculoBdDao;
use Modelo\LimpiarEntrada;
use Modelo\Mensaje;
use Modelo\Rol;
use Modelo\Usuario;

class LoginControladora
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

            $mail = $limpiar->cleanInput($mail);

            $pwd = $limpiar->cleanInput($pwd);

            if (isset($mail) && isset($pwd)) {
                if ($mail === "" || $pwd === "") {
                    /** @noinspection PhpUnusedLocalVariableInspection */
                    $mensaje = new Mensaje('warning', 'Debe llenar todos los campos !');
                } else {
                    $daoU = $this->daoUsuario;
                    /** @var Usuario $usuario */
                    $usuario = $daoU->traerPorMail($mail);

                    if ($mail === $usuario->getEmail() && $pwd === $usuario->getPassword()) {
                        $rol = $usuario->getRol();

                        $_SESSION["mail"] = $mail;
                        $_SESSION["pwd"] = $pwd;
                        $_SESSION["rol"] = $rol->getDescripcion();

                        /** @noinspection PhpUnusedLocalVariableInspection */
                        $mensaje = new Mensaje('success', 'Ha iniciado sesión satisfactoriamente 
                        ! Se ha logueado como' . ' ' . '<i><u>' . $usuario->getEmail() . '</i></u>');
                    } else {
                        /** @noinspection PhpUnusedLocalVariableInspection */
                        $mensaje = new Mensaje('warning', 'Datos de inicio de sesión incorrectos !');
                    }
                }
            } else {

                /** @noinspection PhpUnusedLocalVariableInspection */
                $mensaje = new Mensaje('danger', 'Error al iniciar sesión, intentelo más tarde !');
            }
        } catch (\PDOException $e) {
            /** @noinspection PhpUnusedLocalVariableInspection */
            $mensaje = new Mensaje('danger', 'Hubo un error al conectarse con la base de datos !');
        }

        require("../Vistas/login.php");
    }
}

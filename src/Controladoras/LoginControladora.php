<?php

namespace Controladoras;

use Dao\UsuarioBdDao;
use Modelo\LimpiarEntrada;
use Modelo\Mensaje;
use Modelo\Usuario;

class LoginControladora
{
    //daos
    private $daoUsuario;

    private $mensaje;
    private $limpiar;

    public function __construct()
    {
        $this->limpiar= new LimpiarEntrada();
        /*
         * Los Json DAO no fueron implementados, pero en caso de habelo sido,
         * con descomentar las líneas de abajo hubiera debido el programa de
         * funcionar correctamente.
         */
        $this->daoUsuario = UsuarioBdDao::getInstancia();
        //$this->daoUsuario = UsuarioJsonDao::getInstancia();
    }

    public function index()
    {
        require("../Vistas/login.php");
    }

    public function logueando($mail, $pwd)
    {
        try {
            $this->limpiar->cleanInput($mail);

            $this->limpiar->cleanInput($pwd);

            if (isset($mail) && isset($pwd)) {
                if ($mail === "" || $pwd === "") {
                    $this->mensaje = new Mensaje('warning', 'Debe llenar todos los campos !');
                } else {
                    $daoU = $this->daoUsuario;
                    /** @var Usuario $usuario */
                    $usuario = $daoU->traerPorMail($mail);

                    if ($mail === $usuario->getEmail() && $pwd === $usuario->getPassword()) {
                        $rol = $usuario->getRol();
                        //Seteo las variables de sesión.
                        $_SESSION["mail"] = $mail;
                        $_SESSION["pwd"] = $pwd;
                        $_SESSION["rol"] = $rol->getDescripcion();
                        //Mensaje de success
                        $this->mensaje = new Mensaje('success', 'Ha iniciado sesión satisfactoriamente 
                        ! Se ha logueado como' . ' ' . '<i><strong>' . $usuario->getEmail() . '</strong></i>');
                    } else {
                        $this->mensaje = new Mensaje('warning', 'Datos de inicio de sesión incorrectos !');
                    }
                }
            } else {
                throw new \Exception('Error al iniciar sesión, intentelo más tarde !');
            }
        } catch (\PDOException $e) {
            $this->mensaje = new Mensaje('danger', 'Hubo un error al conectarse con la base de datos !');
        } catch (\Exception $exception) {
            $this->mensaje = new Mensaje('danger', $exception->getMessage());
        }
        //Siempre llevo al usuario al login.
        require("../Vistas/login.php");
    }
}

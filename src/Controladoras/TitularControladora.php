<?php

namespace Controladoras;


use Dao\RolBdDao;
use Dao\TitularBdDao;
use Dao\UsuarioBdDao;
use Modelo\Rol;
use Modelo\Titular;
use Modelo\Usuario;

class titularControladora
{
    function __construct()
    {
    }

    public function buscarDni()
    {
        include("../Vistas/verificarDni.php");
    }


    public function darAltaTitular($nombre, $apellido, $dni, $telefono, $email, $password)
    {

        $daorol = RolBdDao::getInstancia();
        $rol = $daorol->traerPorId(3);
        $usuario = new Usuario($email, $password, $rol);



        try {
            $daousuario = UsuarioBdDao::getInstancia();

            $daousuario->agregar($usuario);

            $usuario = $daousuario->traerPorMail($email);

            $titular = new Titular($nombre, $apellido, $dni, $telefono, $usuario);

            TitularBdDao::getInstancia()->agregar($titular);

            $nombre = "titular";

            include("../Vistas/registroExitoso.php");

        } catch (\Exception $error) {
            echo 'Hubo un error al procesar los datos. Error:' . $error;
        }

    }

    public
    function verificar($dni)
    {
        if (isset($dni)) {
            $titular = $this->existe($dni);

            if ($titular != null) {
                include("../Vistas/altaVehiculo.php");
            } else {
                $this->registrar($dni);
            }
        }
    }

    protected function existe($dni)
    {
        $dao = TitularBdDao::getInstancia();
        //$dao = TitularJsonDao::getInstancia();

        $array = $dao->traerPorDni($dni);

        if (!empty($array)) {
            if ($dni === $array->getDni()) {
                return $array;
            }
        } else {
            return null;
        }
    }

    public function registrar($dni)
    {
        include("../Vistas/altaTitular.php");
    }
}
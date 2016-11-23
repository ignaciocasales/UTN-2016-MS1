<?php

namespace Controladoras;


use Dao\ModeloMarcaDao;
use Dao\RolBdDao;
use Dao\RolJsonDao;
use Dao\TitularBdDao;
use Dao\TitularJsonDao;
use Dao\UsuarioBdDao;
use Dao\UsuarioJsonDao;
use Modelo\Mensaje;
use Modelo\Rol;
use Modelo\Titular;
use Modelo\Usuario;

class titularControladora
{
    private $daoRol;

    private $daoUsuario;

    private $daoTitular;

    private $daoMarcaModelo;

    function __construct()
    {
        /*
         * Los Json DAO no fueron implementados, pero con
         * descomentar las líneas de abajo debería el programa
         * funcionar correctamente.
         */
        $this->daoTitular = TitularBdDao::getInstancia();
        //$this->daoTitular = TitularJsonDao::getInstancia();

        $this->daoUsuario = UsuarioBdDao::getInstancia();
        //$this->daoUsuario = UsuarioJsonDao::getInstancia();

        $this->daoRol = RolBdDao::getInstancia();
        //$this->daoRol = RolJsonDao::getInstancia();

        $this->daoMarcaModelo = ModeloMarcaDao::getInstancia();
    }

    public function buscarDni()
    {
        require("../Vistas/verificarDni.php");
    }

    public function darAltaTitular($nombre, $apellido, $dni, $telefono, $email, $password)
    {

        $daoR = $this->daoRol;
        $rol = $daoR->traerPorId(3);
        $usuario = new Usuario($email, $password, $rol);


        try {
            $daoU = $this->daoUsuario;

            $daoU->agregar($usuario);

            $usuario = $daoU->traerPorMail($email);

            $titular = new Titular($nombre, $apellido, $dni, $telefono, $usuario);

            $this->daoTitular->agregar($titular);

            $nombre = "titular";

            $mensaje = new Mensaje('success', 'Se registro un titular con éxito !');

            require("../Vistas/verificarDni.php");

        } catch (\Exception $error) {

            $mensaje = new Mensaje('success', 'Hubo un error al procesar los datos !');

            require("../Vistas/verificarDni.php");
        }

    }

    public function verificar($dni)
    {
        if (isset($dni)) {
            $titular = $this->existe($dni);

            if ($titular != null) {

                $daoMarcaModelo = $this->daoMarcaModelo;

                $listado = $daoMarcaModelo->traerTodo();

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
<?php

namespace Controladoras;

use Dao\ModeloMarcaDao;
use Dao\RolBdDao;
use Dao\TitularBdDao;
use Dao\UsuarioBdDao;
use Modelo\Mensaje;
use Modelo\Titular;
use Modelo\Usuario;

class TitularControladora
{
    //daos
    private $daoRol;
    private $daoUsuario;
    private $daoTitular;
    private $daoMarcaModelo;

    private $listado;
    public function __construct()
    {
        /*
         * Los Json DAO no fueron implementados, pero en caso de habelo sido,
         * con descomentar las líneas de abajo hubiera debido el programa de
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

    public function buscar()
    {
        require("../Vistas/verificarDni.php");
    }

    public function alta($nombre, $apellido, $dni, $telefono, $email, $password)
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

                $this->listado = $daoMarcaModelo->traerTodo();

                include("../Vistas/altaVehiculo.php");
            } else {
                $this->registrar($dni);
            }
        }
    }

    protected function existe($dni)
    {
        $daoTitular = $this->daoTitular;

        /** @var Titular $titular */
        $titular = $daoTitular->traerPorDni($dni);

        if (!empty($titular)) {
            if ($dni === $titular->getDni()) {
                return $titular;
            }
        }
        return null;
    }

    public function registrar($dni)
    {
        include("../Vistas/altaTitular.php");
    }
}

<?php

namespace Controladoras;

use Dao\UsuarioBdDao;

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
            $rol = $this->existe($mail, $pwd);

            if ($rol == 1) {
                $privilegios = 'developer';
            } else if ($rol == 2) {
                $privilegios = 'empleado';
            } else if ($rol == 2) {
                $privilegios = 'titular';
            }

            if ($mail == "" || $pwd == "") {
                echo "Por favor, completar usuario y clave";
            } else if (!is_null($rol)) {
                $_SESSION["mail"] = $mail;
                $_SESSION["pwd"] = $pwd;
                $_SESSION["rol"] = $privilegios;
            } else {
            }
        }
        header('Location: ' . URL_PUBLIC);
    }

    private function existe($mail, $pwd)
    {
        $dao = new UsuarioBdDao();

        $array = $dao->traeUno($mail);

        if (!empty($array)) {
            if ($mail === $array["mail"] && $pwd === $array["pwd"]) {
                return $array["id_roles"];
            }
        } else {
            return null;
        }
    }
}
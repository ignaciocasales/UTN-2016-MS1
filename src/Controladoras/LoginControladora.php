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
        include("../Vistas/login.php");
    }

    public function verificar($mail, $pwd)
    {

        if (isset($mail) and isset($pwd)) {
            if ($mail == "" || $pwd == "") {
                echo "Por favor, completar usuario y clave";
            } else if ($this->existe($mail, $pwd)) {
                $_SESSION["mail"] = $mail;
                $_SESSION["pwd"] = $pwd;
                echo "Usted se ha identifcado como:  " . $mail;
            } else {
                echo 'datos erroneos';
            }
        }
    }

    private function existe($mail, $pwd)
    {
        $b = new UsuarioBdDao();

        $array = $b->traeUno($mail);

        if (!empty($array)) {
            if ($mail == $array["mail"] && $pwd == $array["pwd"]) {
                return true;
            }
        } else {
            return false;
        }
    }
}
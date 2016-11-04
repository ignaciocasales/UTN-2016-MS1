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

    public function verificar($usuario, $pass)
    {

        /**
         * Estoy trabajando en estas lineas, descomentalas si queres.
         *
         * $v = new UsuarioBdDao();
         * $r=$v->traeTodo();
         * echo $r;
         */


        echo 'FUNCIONA';
        echo '<p>Usuario:' . $usuario . '</p>';
        echo '<p>Contraseña:' . $pass . '</p>';

    }
}
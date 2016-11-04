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


        // Estoy trabajando en estas lineas por motivos de testing, descomentalas si queres .
        // Deberia devolver un array

        $v = new UsuarioBdDao();
        echo '<pre>';
        print_r($v->traeTodo());
        echo '<pre>';


        /*
        echo 'FUNCIONA';
        echo '<p>Usuario:' . $usuario . '</p>';
        echo '<p>Contraseña:' . $pass . '</p>';
        */
    }
}
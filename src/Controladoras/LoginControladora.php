<?php

namespace Controladoras;


class loginControladora
{
    public function __construct()
    {
    }

    public function index()
    {
      include ("../Vistas/login.php");
    }

    public function verificar($usuario, $pass){
        echo 'FUNCIONA';
        echo '<p>Usuario:' . $usuario . '</p>';
        echo '<p>Contraseña:' . $pass . '</p>';

    }
}
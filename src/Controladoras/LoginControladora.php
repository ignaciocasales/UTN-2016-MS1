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

    public function verificar(){
        echo 'FUNCIONA';
    }
}
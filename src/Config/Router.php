<?php

namespace Config;


class Router
{

    public static function direccionar(Request $request)
    {
        $controlador = $request->getControlador() . 'Controladora';
        $metodo = $request->getMetodo();
        $parametros = $request->getParametros();

        //$ruta = ROOT . 'Controladoras/' . $controlador . '.php';

        //require_once $ruta;
        $mostrar = "Controladoras\\" . $controlador;
        $controlador = new $mostrar;
        if (!isset($parametros)) {
            call_user_func(array($controlador, $metodo));
        } else {
            call_user_func_array(array($controlador, $metodo), $parametros);
        }
    }
}
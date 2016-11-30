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
        self::ejecutar(self::instanciar($controlador), $metodo, $parametros);
    }

    private static function instanciar($controlador)
    {
        $mostrar = "Controladoras\\" . $controlador;
        return new $mostrar;
    }

    private static function ejecutar($controlador, $metodo, $parametros)
    {
        if (!isset($parametros)) {
            call_user_func(array($controlador, $metodo));
        } else {
            call_user_func_array(array($controlador, $metodo), $parametros);
        }
    }
}

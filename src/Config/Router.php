<?php namespace Config;

    class Router {
        
        public static function direccionar(Request $request) {
            $controlador = $request->getControlador() . 'Controlador';
            $metodo = $request->getMetodo();
            $parametros = $request->getParametros();


            $ruta = ROOT . 'Controladores/' . $controlador . '.php';
            

            //require_once $ruta;
            $mostrar = "Controladores\\". $controlador;
            $controlador = new $mostrar;
            if(!isset($parametros)) {
                call_user_func(array($controlador, $metodo));
            } else {
                call_user_func_array(array($controlador, $metodo), $parametros);
            }
        }
    }

?>
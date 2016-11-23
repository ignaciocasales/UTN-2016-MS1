<?php

namespace Modelo;

/**
 * Esta clase fue creada para limpiar la entrada por consola,
 * y evitar que se inserte caracteres no deseados. Así como
 * también se trata de evitar SQL injections.
 *
 * Class limpiarEntrada
 * @package Controladoras
 */
class limpiarEntrada
{

    public function __construct()
    {
    }

    /**
     * Esta función deberá recibir un string y devolverá un string.
     *
     * @param $value
     * @return mixed|string
     */
    function clean_input($value)
    {
        //Hago una lista de los caracteres no deseados.
        $bad_chars = array("{", "}", "(", ")", ";", ":", "<", ">", "/", "$");
        //Elimino los caracteres no deseados.
        $value = str_ireplace($bad_chars, "", $value);
        $value = htmlentities($value); // Elimina cualquier entidad HTML
        $value = strip_tags($value); // Elimina posibles tags
        if (get_magic_quotes_gpc()) {

            $value = stripslashes($value); // Elimina comillas

        }
        return $value;
    }
}
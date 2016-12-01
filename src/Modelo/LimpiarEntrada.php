<?php

namespace Modelo;

/**
 * Esta clase fue creada para limpiar la entrada por consola
 * utilizando una serie de filtros, y evitar que se inserte
 * caracteres no deseados. Así como también se trata de
 * evitar SQL injections.
 *
 * Class LimpiarEntrada
 * @package Modelo
 */
class LimpiarEntrada
{

    public function __construct()
    {
    }

    /**
     * @param $value string
     * @return string
     */
    public function cleanInput(&$value)
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

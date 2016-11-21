<?php

namespace Controladoras;


class limpiarEntrada
{

    public function __construct()
    {
    }

    /*Esta funcion debe recibir un string y devuelve un string*/
    function clean_input($value)
    {
        $bad_chars = array("{", "}", "(", ")", ";", ":", "<", ">", "/", "$");
        $value = str_ireplace($bad_chars, "", $value);
        $value = htmlentities($value); // Removes any html from the string and turns it into &lt; format
        $value = strip_tags($value); // Strips html and PHP tags
        if (get_magic_quotes_gpc()) {

            $value = stripslashes($value); // Gets rid of unwanted quotes

        }
        return $value;
    }
}
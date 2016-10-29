<?php

namespace Config;

class Autoload
{

    public static function iniciar()
    {
        spl_autoload_register(function ($class) {
            $classPath = ROOT . $class . ".php";
            //echo '<p>' . $classPath  . '</p>';
            include_once($classPath);
        });
    }
}
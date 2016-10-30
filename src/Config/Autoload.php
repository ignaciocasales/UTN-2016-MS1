<?php

namespace Config;

class Autoload
{

    public static function iniciar()
    {
        spl_autoload_register(function ($class) {
            $classPath = ROOT . str_replace("\\", "/", $class) . ".php";
            //echo '<p>' . $class . '</p>';
            //echo '<p>' . $classPath . '</p>';
            include_once($classPath);
        });
    }
}
<?php namespace Config;

    class Autoload {
        
        public static function iniciar() {
            spl_autoload_register(function($classPath)
			{
				$class = ROOT . str_replace("\\", "/", $classPath)  . ".php";
				//echo '<p>' . $class  . '</p>';
				include_once($class);
			});
        }
    }
?>
<?php
    
    namespace config;

    class Autoload{
        
        public function iniciar(){
            spl_autoload_register(function($NombreClase){
                $file_path = str_replace("/" , "\ " , $NombreClase);
                require_once $filename; 
            });
        }
    }


?>
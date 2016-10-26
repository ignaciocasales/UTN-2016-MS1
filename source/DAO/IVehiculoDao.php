<?php

    interface IVehiculoDao{
        public function borrar($patente);
        
        public function agregar($vehiculo);
        
        public function dameTodos();
        
        public function damePorPatente($patente);
    }

?>
<?php

    interface IPersonaDao{
    
        public function agregar($persona);
        public function dameTodos();
        public function buscarDni($dni);
    }

?>
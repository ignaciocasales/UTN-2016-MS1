<?php

namespace Dao;


interface TitularIDao
{
    public function agregar($titular);

    public function eliminar($dni);

    public function actualizar($titular);

    public function traeTodo();

    public function traerPorDni($dni);

}
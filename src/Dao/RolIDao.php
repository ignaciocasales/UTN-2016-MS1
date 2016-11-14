<?php

namespace Dao;


interface RolIDao
{
    public function agregar($rol);

    public function eliminar($rol);

    public function actualizar($rol);

    public function traeTodo();

    public function traerPorId($id);

    public function mapear($dataSet);
}
<?php

namespace Dao;


interface RolIDao
{
    public function agregar($valor);

    public function eliminar($valor);

    public function actualizar($valor);

    public function traeTodo();

    public function traerPorId($id);

    public function mapear($dataSet);
}
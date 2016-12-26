<?php

namespace Dao;

use Modelo\Rol;

interface RolIDao
{
    public function agregar(Rol $rol);

    public function eliminar($id);

    public function actualizar(Rol $rol);

    public function traeTodo();

    public function traerPorId($id);

    public function mapear($dataSet);
}

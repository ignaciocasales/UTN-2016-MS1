<?php

namespace Dao;

use Modelo\Titular;

interface TitularIDao
{
    public function agregar(Titular $titular);

    public function eliminarPorId($id);

    public function eliminarPorDni($dni);

    public function actualizar(Titular $titular);

    public function traeTodo();

    public function traerPorIdUsuario($idUsuario);

    public function traerPorId($id);

    public function traerPorDni($dni);

    public function mapear($dataSet);
}

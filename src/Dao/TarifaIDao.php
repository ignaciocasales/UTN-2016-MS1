<?php

namespace Dao;

use Modelo\Tarifa;

interface TarifaIDao
{
    public function agregar(Tarifa $tarifa);

    public function actualizar(Tarifa $tarifa);

    public function traeTodo();

    public function traerPorId($id);

    public function traerPorFecha($fecha);

    public function mapear($dataSet);
}

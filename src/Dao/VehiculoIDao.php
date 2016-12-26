<?php

namespace Dao;

use Modelo\Vehiculo;

interface VehiculoIDao
{
    public function agregar(Vehiculo $vehiculo);

    public function eliminarPorId($id);

    public function eliminarPorDominio($dominio);

    public function actualizar(Vehiculo $vehiculo);

    public function traerTodo();

    public function traerPorId($id);

    public function traerPorDominio($dominio);

    public function mapear($dataSet);
}

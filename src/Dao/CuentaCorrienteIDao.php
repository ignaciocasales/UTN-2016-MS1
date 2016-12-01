<?php

namespace Dao;


use Modelo\CuentaCorriente;

interface CuentaCorrienteIDao
{
    public function agregar(CuentaCorriente $cuentaCorriente);

    public function eliminar($id);

    public function actualizar(CuentaCorriente $cuentaCorriente);

    public function traerTodo();

    public function traerPorId($id);

    public function traerPorVehiculo($id);

    public function mapear($dataSet);
}
<?php

namespace Dao;


interface CuentaCorrienteIDao
{
    public function agregar($cuentaCorriente);

    public function eliminar($id);

    public function actualizar($cuentaCorriente);

    public function traerTodo();

    public function traerPorId($id);

    public function mapear($dataSet);
}
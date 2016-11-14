<?php

namespace Dao;


interface CuentaCorrienteIDao
{
    public function agregar($cuentas_corrientes);

    public function eliminar($cuentas_corrientes);

    public function actualizar($cuentas_corrientes);

    public function traerTodo();

    public function traerPorId($id);

    public function mapear($dataSet);
}
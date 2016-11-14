<?php

namespace Dao;


interface MovimientoCuentaCorrienteIDao
{
    public function agregar($movimientoCC);

    public function eliminar($movimientoCC);

    public function actualizar($movimientoCC);

    public function traerTodo();

    public function traerPorId($id);

    public function mapear($dataSet);
}
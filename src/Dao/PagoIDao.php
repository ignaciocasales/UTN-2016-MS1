<?php

namespace Dao;


interface PagoIDao
{
    public function agregar($pago);

    public function eliminar($pago);

    public function actualizar($pago);

    public function traerTodo();

    public function traerPorId($id);

    public function mapear($dataSet);
}
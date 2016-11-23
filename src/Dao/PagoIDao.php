<?php

namespace Dao;


interface PagoIDao
{
    public function agregar($pago);

    public function traerTodo();

    public function traerPorId($id);

    public function mapear($dataSet);
}
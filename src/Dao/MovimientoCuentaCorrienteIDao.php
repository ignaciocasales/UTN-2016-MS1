<?php

namespace Dao;


interface MovimientoCuentaCorrienteIDao
{
    public function agregar($movimiento);

    public function traerTodo();

    public function traerPorId($id);

    public function traerTodoPorIdCuentaCorriente($idCC);

    public function mapear($dataSet);
}
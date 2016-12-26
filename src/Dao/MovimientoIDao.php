<?php

namespace Dao;

use Modelo\MovimientoCuentaCorriente;

interface MovimientoIDao
{
    public function agregar(MovimientoCuentaCorriente $movimiento);

    public function traerTodo();

    public function traerPorId($id);

    public function traerTodoPorIdCuentaCorriente($idCC);

    public function mapear($dataSet);
}

<?php

namespace Dao;


interface MovimientoCuentaCorrienteIDao
{
    public function agregar($movimiento);

    //No tiene sentido actualizar o eliminar un pago. Una vez pagado, ya está.

    public function traerTodo();

    public function traerPorId($id);

    public function mapear($dataSet);
}
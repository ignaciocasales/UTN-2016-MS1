<?php

namespace Dao;


interface TarifaIDao
{
    public function agregar($tarifa);

    //me parecio que no tiene sentido eliminar un tarifario.

    public function actualizar($tarifa);

    public function traeTodo();

    public function traerPorId($id);

    public function mapear($dataSet);

}
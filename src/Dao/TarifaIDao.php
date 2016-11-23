<?php

namespace Dao;


interface TarifaIDao
{
    public function agregar($tarifa);

    public function actualizar($tarifa);

    public function traeTodo();

    public function traerPorId($id);

    public function traerPorFecha($fecha);

    public function mapear($dataSet);

}
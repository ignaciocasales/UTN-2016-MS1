<?php

namespace Dao;


interface SensorIDao
{
    public function agregar($sensor);

    public function traerTodo();

    public function traerPorId($id);

    public function mapear($dataSet);
}
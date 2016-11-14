<?php

namespace Dao;


interface EventoMultaIDao
{
    public function agregar($movimiento);

    public function traerTodo();

    public function traerPorId($id);

    public function mapear($dataSet);
}
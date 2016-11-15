<?php

namespace Dao;


interface EventoIDao
{
    public function agregar($evento);

    public function traerTodo();

    public function traerPorId($id);

    public function mapear($dataSet);
}
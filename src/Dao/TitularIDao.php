<?php

namespace Dao;


interface TitularIDao
{
    public function agregar($titular);

    public function eliminarPorId($id);

    public function eliminarPorDni($dni);

    public function actualizar($titular);

    public function traeTodo();

    public function traerPorId($id);

    public function traerPorDni($dni);

    public function mapear($dataSet);
}
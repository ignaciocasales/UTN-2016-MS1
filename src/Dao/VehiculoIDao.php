<?php

namespace Dao;


interface VehiculoIDao
{
    public function agregar($vehiculo);

    public function eliminarPorDominio($dominio);

    public function actualizar($vehiculo);

    public function traerTodo();

    public function traerPorId($id);

    public function traerPorDominio($dominio);

    public function mapear($dataSet);
}
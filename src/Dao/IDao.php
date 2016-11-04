<?php

namespace Dao;


interface IDao
{
    public function agregar($valor);

    public function eliminar($valor);

    public function actualizar($valor);

    public function traeTodo();

    public function traeUno($valor);
}
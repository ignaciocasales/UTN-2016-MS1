<?php

namespace Dao;


interface UsuarioIDao
{
    public function agregar($valor);

    public function eliminar($valor);

    public function actualizar($valor);

    public function traeTodo();

    public function traerPorMail($mail);

    public function mapear($dataSet);
}
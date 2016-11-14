<?php

namespace Dao;


interface UsuarioIDao
{
    public function agregar($usuario);

    public function eliminarPorId($id);

    public function eliminarPorMail($mail);

    public function actualizar($usuario);

    public function traerTodo();

    public function traerPorId($id);

    public function traerPorMail($mail);

    public function mapear($dataSet);
}
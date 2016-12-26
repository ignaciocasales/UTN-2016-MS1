<?php

namespace Dao;

use Modelo\Usuario;

interface UsuarioIDao
{
    public function agregar(Usuario $usuario);

    public function eliminarPorId($id);

    public function eliminarPorMail($mail);

    public function actualizar(Usuario $usuario);

    public function traerTodo();

    public function traerPorId($id);

    public function traerPorMail($mail);

    public function mapear($dataSet);
}

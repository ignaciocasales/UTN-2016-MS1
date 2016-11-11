<?php

namespace Dao;


interface UsuarioIDao
{
    public function agregar($usuario);

    public function eliminar($idIdUsuario);

    public function actualizar($usuario);

    public function traeTodo();

    public function traerPorMail($mail);

    public function mapear($dataSet);
}
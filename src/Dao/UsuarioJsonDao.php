<?php

namespace Dao;


class UsuarioJsonDao extends Conexion implements IDao
{
    private static $instancia;

    public static function getInstancia()
    {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function agregar($valor)
    {
        // TODO: Implement agregar() method.
    }

    public function eliminar($valor)
    {
        // TODO: Implement eliminar() method.
    }

    public function actualizar($valor)
    {
        // TODO: Implement actualizar() method.
    }

    public function traeTodo()
    {
        // TODO: Implement traeTodo() method.
    }

    public function traeUno($valor)
    {
        // TODO: Implement traeUno() method.
    }
}
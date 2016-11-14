<?php

namespace Dao;


class EventoPeajeBdDao implements EventoPeajeIDao
{
    protected $tabla = "eventos";
    protected $listado;
    private static $instancia;

    public static function getInstancia()
    {
        if (!self::$instancia instanceof self) {

            self::$instancia = new self();

        }

        return self::$instancia;
    }

    public function agregar($movimiento)
    {
        // TODO: Implement agregar() method.
    }

    public function traerTodo()
    {
        // TODO: Implement traerTodo() method.
    }

    public function traerPorId($id)
    {
        // TODO: Implement traerPorId() method.
    }

    public function mapear($dataSet)
    {
        // TODO: Implement mapear() method.
    }
}
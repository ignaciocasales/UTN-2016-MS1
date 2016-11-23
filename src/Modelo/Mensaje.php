<?php

namespace Modelo;


/**
 * Esta clase fue creada para crear y mostrar mensajes por pantalla.
 * Esta clase no es óptima ya que esta acoplada a bootstrap.
 *
 * Class Mensaje
 * @package Controladoras
 */
class Mensaje
{

    private $tipo;
    private $mensaje;

    public function __construct($tipo, $mensaje)
    {
        $this->tipo = $tipo;
        $this->mensaje = $mensaje;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }
}
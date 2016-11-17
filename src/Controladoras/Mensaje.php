<?php

namespace Controladoras;



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
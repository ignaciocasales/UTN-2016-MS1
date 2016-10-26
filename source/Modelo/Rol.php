<?php


namespace Modelo;


/**
 * @author Damian
 * @version 1.0
 * @created 22-oct-2016 05:07:00 p.m.
 */
class Rol implements JsonSerializable
{

	private $descripcion;

	function __construct($descripcion)
	{
        $this->descripcion = $descripcion;
	}

	function __destruct(){}
    
    public function setDescripcion ($descripcion){
        $this->descripcion = $descripcion;
    }
    
    public function getDescripcion(){
        return $this->descripcion;
    }

    public function jsonSerialize(){
        return [
            'descripcion' => $this->descripcion
        ]
    }

}
?>
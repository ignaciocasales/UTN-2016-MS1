<?php
require_once ('Vehiculo.php');

namespace Modelo;



use Modelo;
/**
 * @author Damian
 * @version 1.0
 * @created 22-oct-2016 05:09:19 p.m.
 */
class Titular implements JsonSerializable
{

	private $apellido;
	private $dni;
	private $nombre;
	private $telefono;
    private $m_Usuario;

	function __construct($apellido = '',$dni,$nombre = '',$telefono,$usuario)
	{
        $this->apellido  = $apellido;
        $this->dni       = $dni;
        $this->nombre    = $nombre;
        $this->telefono  = $telefono;
        $this->m_Usuario = $usuario;
	}

	function __destruct(){}

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }
        
    public function setDni($dni){
        $this->dni = $dni;
    }   
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }    
    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }    
    public function setUsuario($usuario){
        $this->m_Usuario = $usuario;
    }
    
    public function getApellido(){
        return $this->apellido;
    }
    public function getDni(){
        return $this->dni;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function getUsuario(){
        return $this->m_Usuario;
    }
    
    public function jsonSerialize(){
        return [
            'apellido'  => $this->apellido,
            'dni'       => $this->dni,
            'nombre'    => $this->nombre,
            'telefono'  => $this->telefono,
            'usuario '  => $this->m_Usuario
        ]
    }
}
?>
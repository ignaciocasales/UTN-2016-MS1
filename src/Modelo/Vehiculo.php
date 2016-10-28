<?php
require_once ('CuentaCte.php');

namespace Modelo;



use Modelo;
/**
 * @author Damian
 * @version 1.0
 * @created 22-oct-2016 05:09:55 p.m.
 */
class Vehiculo implements JsonSerializable
{

	private $dominio;
	private $marca;
	private $modelo;
	private $QR;
    private $m_Titular

	function __construct($dominio = '',$marca = '',$modelo = '',$QR = '',$titular)
	{
        $this->dominio    = $dominio;
        $this->marca      = $marca;
        $this->modelo     = $modelo;
        $this->QR         = $QR;
        $this->m_Titular    = $titular;
	}

	function __destruct(){}
    
    public function setDominio($dominio = ''){
        $this->dominio = $dominio;
    }
    
    public function setMarca($marca = ''){
        $this->marca = $marca;
    }
    
    public function setModelo($modelo = ''){
        $this->modelo = $modelo;
    }
   
    public function setQR($QR = ''){
        $this->QR = $QR;
    }
    
    public function setTitular($titular){
        $this->m_Titular = $titular;
    }
    
    public function getDominio(){
        return $this->dominio;
    }
    
    public function getMarca(){
        return $this->marca;
    }
    
    public function getModelo(){
        return $this->modelo;
    }
    
    public function getTitular(){
        return $this->m_Titular;
    }
   
    public function getQR(){
        return $this->QR;
    }
    
    public function jsonSerialize(){
        return [
            'dominio'     => $this->dominio,
            'marca'       => $this->marca,
            'modelo'      => $this->modelo,
            'QR'          => $this->QR,
            'titular'     => $this->m_Titular
        ]
    }


    
}
?>
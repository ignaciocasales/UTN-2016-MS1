<?php

namespace Dao;


use Dao\IDao;
use Dao\Conexion as Conexion;

class UsuarioBdDao extends Conexion implements IDao
{
    protected $tabla = "usuarios";

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

        // Guardo como string la consulta sql
        $sql = "SELECT * FROM " . $this->tabla;


        // creo el objeto conexion
        $obj_pdo = new Conexion();


        // Conecto a la base de datos.
        $conexion = $obj_pdo->conectar();


        // Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
        $sentencia = $conexion->prepare($sql);


        // Ejecuto la sentencia.
        $sentencia->execute();


        while ($row = $sentencia->fetch()) {
            $array[] = $row;
        }
        if (!empty($array)) return $array;
    }

    public function traeUno($valor)
    {
        // TODO: Implement traeUno() method.
    }

}
<?php

namespace Dao;


use Dao\IDao;
use Dao\Conexion as Conexion;

class UsuarioBdDao extends Conexion implements IDao
{
    protected $tabla = "usuarios";
    private static $instancia;

    public static function getInstancia(){
        if(!self::$instancia instanceof self){
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function agregar($valor)
    {
        // Guardo como string la consulta sql utilizando como values, marcadores de parámetros
        // con nombre (:name) o signos de interrogación (?) por los cuales los valores reales
        // serán sustituidos cuando la sentencia sea ejecutada

        $sql = "INSERT INTO $this->tabla (nombre) VALUES (:nombre)";

        // creo el objeto conexion
        //$obj_pdo = new Conexion();


        // Conecto a la base de datos.
        $conexion = Conexion::conectar();


        // Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
        $sentencia = $conexion->prepare($sql);


        // Reemplazo los marcadores de parametro por los valores reales utilizando el método bindParam().
        $sentencia->bindParam(":nombre", $value);


        // Ejecuto la sentencia.
        $sentencia->execute();
    }

    public function eliminar($valor)
    {
        // Guardo como string la consulta sql
        $sql = "DELETE FROM $this->tabla WHERE id_usuarios = $valor";


        // creo el objeto conexion
        $obj_pdo = new Conexion();


        // Conecto a la base de datos.
        $conexion = $obj_pdo->conectar();


        // Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
        $sentencia = $conexion->prepare($sql);


        // Ejecuto la sentencia.
        $sentencia->execute();
    }

    public function actualizar($valor)
    {
        // TODO: Implement actualizar() method.
    }

    public function traeTodo()
    {

        // Guardo como string la consulta sql
        $sql = "SELECT * FROM $this->tabla";


        // creo el objeto conexion
        $obj_pdo = new Conexion();


        // Conecto a la base de datos.
        $conexion = $obj_pdo->conectar();


        // Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
        $sentencia = $conexion->prepare($sql);


        // Ejecuto la sentencia.
        $sentencia->execute();


        while ($row = $sentencia->fetch(\PDO::FETCH_ASSOC)) {
            $array[] = $row;
        }
        if (!empty($array)) return $array;
    }

    public function traeUno($valor)
    {
        $sql = "SELECT * FROM $this->tabla WHERE mail =  '$valor'";

        $obj_pdo = new Conexion();

        $conexion = $obj_pdo->conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $row = $sentencia->fetch(\PDO::FETCH_ASSOC);

        if (!empty($row)) return $row;
    }

    private function mapear($dataSet)
    {

    }
}
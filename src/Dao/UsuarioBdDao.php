<?php

namespace Dao;


use Dao\IDao;
use Dao\Conexion as Conexion;
use Modelo\Usuario;

class UsuarioBdDao extends Conexion implements IDao
{
    protected $tabla = "usuarios";
    protected $listado;
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


        // Conecto a la base de datos.
        $conexion = Conexion::conectar();


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


        // Conecto a la base de datos.
        $conexion = Conexion::conectar();


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
        $sql = "SELECT * FROM $this->tabla WHERE mail =  '$valor' LIMIT 1";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) return $this->listado[0];
    }

    protected function mapear($dataSet)
    {
        $dataSet = is_array($dataSet) ? $dataSet : [];
        $this->listado = array_map(function($p){
            return new Usuario($p['mail'],$p['pwd'],$p['id_roles']);
        }, $dataSet);
    }
}
<?php

namespace Dao;

use Dao\IDao;
use Dao\Conexion as Conexion;

class TitularBdDao implements TitularIDao
{
    protected $tabla = "titulares";
    private static $instancia;

    public static function getInstancia()
    {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function agregar($titular)
    {

        $sql = "INSERT INTO $this->tabla (nombre, apellido, dni, telefono, id_usuarios) VALUES (:nombre, :apellido, :dni, :telefono, (SELECT id_usuarios FROM usuarios WHERE mail = :mail))";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $nombre   = $titular->getNombre();
        $apellido = $titular->getApellido();
        $dni      = $titular->getDni();
        $telefono = $titular->getTelefono();
        $usuario  = $titular->getUsuario();
        $mail    = $usuario->getEmail();


        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":apellido", $apellido);
        $sentencia->bindParam(":dni", $dni);
        $sentencia->bindParam(":telefono", $telefono);
        $sentencia->bindParam(":mail", $mail);

        $sentencia->execute();
        /*// Guardo como string la consulta sql utilizando como values, marcadores de parámetros
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
        $sentencia->execute();*/
    }

    public function eliminar($dni)
    {
        // Guardo como string la consulta sql
        $sql = "DELETE FROM $this->tabla WHERE dni = $dni";


        // creo el objeto conexion
        $obj_pdo = new Conexion();


        // Conecto a la base de datos.
        $conexion = $obj_pdo->conectar();


        // Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
        $sentencia = $conexion->prepare($sql);


        // Ejecuto la sentencia.
        $sentencia->execute();
    }

    public function actualizar($titular)
    {
        // TODO: Implement actualizar() method.
    }

    public function traerPorDni($dni){
        
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
        $sql = "SELECT * FROM $this->tabla WHERE dni =  '$valor'";

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
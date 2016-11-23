<?php

namespace Dao;

use Dao\IDao;
use Dao\Conexion as Conexion;
use Modelo\Titular;

class TitularBdDao implements TitularIDao
{
    protected $tabla = "titulares";
    protected $listado;
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

        $sql = "INSERT INTO $this->tabla (nombre, apellido, dni, telefono, id_usuarios) VALUES (:nombre, :apellido, :dni, :telefono, :idUsuarios)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $nombre = $titular->getNombre();
        $apellido = $titular->getApellido();
        $dni = $titular->getDni();
        $telefono = $titular->getTelefono();
        $usuario = $titular->getUsuario();
        $idUsuarios = $usuario->getId();

        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":apellido", $apellido);
        $sentencia->bindParam(":dni", $dni);
        $sentencia->bindParam(":telefono", $telefono);
        $sentencia->bindParam(":idUsuarios", $idUsuarios);

        $sentencia->execute();

        return $conexion->lastInsertId();
    }

    public function eliminarPorId($id)
    {
        $sql = "DELETE FROM $this->tabla WHERE dni = \"$id\"";

        $obj_pdo = new Conexion();

        $conexion = $obj_pdo->conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }

    public function eliminarPorDni($dni)
    {
        $sql = "DELETE FROM $this->tabla WHERE dni = \"$dni\"";

        $obj_pdo = new Conexion();

        $conexion = $obj_pdo->conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }

    public function actualizar($titular)
    {
        $sql = "UPDATE $this->tabla SET nombre = :nombre, apellido = :apellido, telefono = :telefono, dni = :dni  WHERE id_titulares = :id";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $nombre = $titular->getNombre();
        $apellido = $titular->getApellido();
        $telefono = $titular->getTelefono();
        $dni = $titular->getDni();
        $id = $titular->getId();

        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":apellido", $apellido);
        $sentencia->bindParam(":telefono", $telefono);
        $sentencia->bindParam(":dni", $dni);
        $sentencia->bindParam(":id", $id);

        $sentencia->execute();
    }

    public function traeTodo()
    {
        $sql = "SELECT * FROM $this->tabla";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet = $sentencia->fetchall(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado)) return $this->listado;
    }

    public function traerPorIdUsuario($idUsuario)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_usuarios = '$idUsuario'";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) return $this->listado[0];

    }

    public function traerPorId($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_titulares =  \"$id\" LIMIT 1";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) return $this->listado[0];
    }

    public function traerPorDni($dni)
    {
        $sql = "SELECT * FROM $this->tabla WHERE dni = \"$dni\"";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) return $this->listado[0];
    }

    public function mapear($dataSet)
    {
        $dataSet = is_array($dataSet) ? $dataSet : [];
        $this->listado = array_map(function ($p) {

            $usuarioDao = UsuarioBdDao::getInstancia();

            $t = new Titular($p['nombre'], $p['apellido'], $p['dni'], $p['telefono'], $usuarioDao->traerPorId($p['id_usuarios']));

            $t->setId($p['id_titulares']);

            return $t;

        }, $dataSet);
    }
}
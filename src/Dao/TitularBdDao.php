<?php

namespace Dao;

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

    public function agregar(Titular $titular)
    {
        /** @noinspection SqlResolve */
        $sql = "INSERT INTO $this->tabla  (nombre, apellido, dni, telefono, idUsuario) 
                VALUES (:nombre, :apellido, :dni, :telefono, :idUsuarios)";

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
        /** @noinspection SqlResolve */
        $sql = "DELETE FROM $this->tabla WHERE idTitular = \"$id\"";

        $obj_pdo = new Conexion();

        $conexion = $obj_pdo->conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }

    public function eliminarPorDni($dni)
    {
        /** @noinspection SqlResolve */
        $sql = "DELETE FROM $this->tabla WHERE dni = \"$dni\"";

        $obj_pdo = new Conexion();

        $conexion = $obj_pdo->conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }

    public function actualizar(Titular $titular)
    {
        /** @noinspection SqlResolve */
        $sql = "UPDATE $this->tabla 
                SET nombre = :nombre, apellido = :apellido, telefono = :telefono, dni = :dni  
                WHERE idTitular = :id";

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

        if (!empty($this->listado)) {
            return $this->listado;
        }
        return null;
    }

    public function traerPorIdUsuario($idUsuario)
    {
        /** @noinspection SqlResolve */
        $sql = "SELECT * FROM $this->tabla WHERE idUsuario = '$idUsuario'";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) {
            return $this->listado[0];
        }
        return null;
    }

    public function traerPorId($id)
    {
        /** @noinspection SqlResolve */
        $sql = "SELECT * FROM $this->tabla WHERE idTitular =  \"$id\" LIMIT 1";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) {
            return $this->listado[0];
        }
        return null;
    }

    public function traerPorDni($dni)
    {
        /** @noinspection SqlResolve */
        $sql = "SELECT * FROM $this->tabla WHERE dni = \"$dni\"";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) {
            return $this->listado[0];
        }
        return null;
    }

    public function mapear($dataSet)
    {
        $dataSet = is_array($dataSet) ? $dataSet : [];
        $this->listado = array_map(function ($p) {
            $usuarioDao = UsuarioBdDao::getInstancia();
            $t = new Titular(
                $p['nombre'],
                $p['apellido'],
                $p['dni'],
                $p['telefono'],
                $usuarioDao->traerPorId($p['idUsuario'])
            );
            $t->setId($p['idTitular']);
            return $t;
        }, $dataSet);
    }
}

<?php

namespace Dao;

use Modelo\Usuario;

class UsuarioBdDao implements UsuarioIDao
{
    protected $tabla = "usuarios";
    protected $listado;
    private static $instancia;

    public static function getInstancia()
    {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    private function __construct()
    {
    }

    public function agregar(Usuario $usuario)
    {
        /** @noinspection SqlResolve */
        $sql = "INSERT INTO $this->tabla (correo, pwd, idRol) VALUES (:mail, :pwd, :idRoles)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $mail = $usuario->getEmail();
        $pwd = $usuario->getPassword();

        $r = $usuario->getRol();
        $idRoles = $r->getId();

        $sentencia->bindParam(":mail", $mail);
        $sentencia->bindParam(":pwd", $pwd);
        $sentencia->bindParam(":idRoles", $idRoles);

        $sentencia->execute();

        return $conexion->lastInsertId();
    }

    public function eliminarPorId($id)
    {
        /** @noinspection SqlResolve */
        $sql = "DELETE FROM $this->tabla WHERE idUsuario = \"$id\"";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }

    public function eliminarPorMail($mail)
    {
        /** @noinspection SqlResolve */
        $sql = "DELETE FROM $this->tabla WHERE correo = \"$mail\"";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }

    public function actualizar(Usuario $usuario)
    {
        /** @noinspection SqlResolve */
        $sql = "UPDATE $this->tabla SET correo = :mail, pwd = :pwd, idRol = :idRoles WHERE idUsuario = :idUsuarios";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $mail = $usuario->getEmail();
        $idUsuarios = $usuario->getId();
        $pwd = $usuario->getPassword();

        $r = $usuario->getRol();
        $idRoles = $r->getId();

        $sentencia->bindParam(":mail", $mail);
        $sentencia->bindParam(":pwd", $pwd);
        $sentencia->bindParam(":idRoles", $idRoles);
        $sentencia->bindParam(":idUsuarios", $idUsuarios);

        $sentencia->execute();
    }

    public function traerTodo()
    {
        $sql = "SELECT * FROM $this->tabla";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet = $sentencia->fetchAll(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado)) {
            return $this->listado;
        }
        return null;
    }

    public function traerPorId($id)
    {
        /** @noinspection SqlResolve */
        $sql = "SELECT * FROM $this->tabla WHERE idUsuario =  \"$id\" LIMIT 1";

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

    public function traerPorMail($mail)
    {
        /** @noinspection SqlResolve */
        $sql = "SELECT * FROM $this->tabla WHERE correo =  \"$mail\" LIMIT 1";

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
            $daoRol = RolBdDao::getInstancia();
            $u = new Usuario(
                $p['correo'],
                $p['pwd'],
                $daoRol->traerPorId($p['idRol'])
            );
            $u->setId($p['idUsuario']);
            return $u;
        }, $dataSet);
    }
}

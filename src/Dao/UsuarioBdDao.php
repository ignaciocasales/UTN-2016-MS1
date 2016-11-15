<?php

namespace Dao;


use Dao\IDao;
use Dao\Conexion as Conexion;
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

    public function agregar($usuario)
    {
        $sql = "INSERT INTO $this->tabla (mail, pwd, id_roles) VALUES (:mail, :pwd, :idRoles)";

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
    }

    public function eliminarPorId($id)
    {
        $sql = "DELETE FROM $this->tabla WHERE id_usuarios = \"$id\"";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }

    public function eliminarPorMail($mail)
    {
        $sql = "DELETE FROM $this->tabla WHERE mail = \"$mail\"";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }

    public function actualizar($usuario)
    {
        $sql = "UPDATE $this->tabla SET mail = :mail, pwd = :pwd, id_roles = :idRoles WHERE id_usuarios = :idUsuarios";

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

        if (!empty($this->listado)) return $this->listado;
    }

    public function traerPorId($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_usuarios =  \"$id\" LIMIT 1";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet[] = $sentencia->fetch(\PDO::FETCH_ASSOC);

        $this->mapear($dataSet);

        if (!empty($this->listado[0])) return $this->listado[0];
    }

    public function traerPorMail($mail)
    {
        $sql = "SELECT * FROM $this->tabla WHERE mail =  \"$mail\" LIMIT 1";

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

            $daoRol = RolBdDao::getInstancia();

            $u = new Usuario($p['mail'], $p['pwd'], $daoRol->traerPorId($p['id_roles']));

            $u->setId($p['id_usuarios']);

            return $u;

        }, $dataSet);
    }
}
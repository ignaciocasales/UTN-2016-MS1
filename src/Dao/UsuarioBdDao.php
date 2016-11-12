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
        $sql = "INSERT INTO $this->tabla (mail, pwd, id_roles) VALUES (:mail, :pwd, :rol)";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->bindParam(":mail", $usuario->getEmail());
        $sentencia->bindParam(":pwd", $usuario->getPassword());
        $sentencia->bindParam(":rol", $usuario->getRol());

        $sentencia->execute();
    }

    public function eliminar($idUsuario)
    {
        $sql = "DELETE FROM $this->tabla WHERE id_usuarios = $idUsuario";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();
    }

    public function actualizar($usuario)
    {
        $sql = "UPDATE $this->tabla SET mail = :mail, pwd = :pwd, id_roles = :rol WHERE id_usuarios = :id";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->bindParam(":mail", $usuario->getEmail());
        $sentencia->bindParam(":pwd", $usuario->getPassword());
        $sentencia->bindParam(":rol", $usuario->getRol());

        $sentencia->execute();
    }

    public function traeTodo()
    {
        $sql = "SELECT * FROM $this->tabla";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet = $sentencia->fetchall(\PDO::FETCH_ASSOC);
        echo '<pre>';
        print_r($dataSet);
        echo '</pre>';
        $this->mapear($dataSet);

        if (!empty($this->listado)) return $this->listado;
    }

    public function traerPorMail($mail)
    {
        $sql = "SELECT * FROM $this->tabla WHERE mail =  '$mail' LIMIT 1";

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
            return new Usuario($p['mail'], $p['pwd'], $daoRol->traerPorId($p['id_roles']));
        }, $dataSet);
    }
}
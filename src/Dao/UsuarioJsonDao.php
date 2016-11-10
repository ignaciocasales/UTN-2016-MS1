<?php

namespace Dao;


use Modelo\Usuario;

class UsuarioJsonDao implements UsuarioIDao
{
    private static $instancia;
    private $listado;
    private $ruta;

    public static function getInstancia()
    {
        if (!self::$instancia instanceof self) {

            self::$instancia = new self();

        }

        return self::$instancia;
    }

    public function __construct($ruta = __DIR__ . '\json\usuarios.txt')
    {
        if (!file_exists($ruta)) {

            echo 'No existe el archivo';
            //throw new Exception('No existe el archivo');

        }

        $this->ruta = $ruta;
        $this->leer();
    }

    public function __destruct()
    {
        $archivo = fopen($this->ruta, 'w');

        fwrite($archivo, json_encode($this->listado));

        fclose($archivo);
    }

    protected function leer()
    {
        $archivo = fopen($this->ruta, "r");

        $dataSet = json_decode(fgets($archivo), true);

        $this->mapear($dataSet);

        fclose($archivo);
    }

    public function agregar($usuario)
    {
        $this->listado[] = $usuario;
    }

    public function eliminar($usuario)
    {
        if (($key = array_search($usuario, $this->listado, true)) !== FALSE) {
            unset($this->listado[$key]);
        }
    }

    public function actualizar($usuario)
    {
    }

    public function traeTodo()
    {
        return $this->listado;
    }

    public function traerPorMail($mail)
    {
        return array_filter($this->listado, function ($p) use ($mail) {

            return $p->getEmail() == $mail;

        });
    }

    public function mapear($dataSet)
    {
        $dataSet = is_array($dataSet) ? $dataSet : [];
        $this->listado = array_map(function ($p) use ($dataSet) {
            return new Usuario($p['id'], $p['mail'], $p['pwd'], $p['id_roles']);
        }, $dataSet);
    }
}
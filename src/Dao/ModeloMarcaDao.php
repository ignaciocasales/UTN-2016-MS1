<?php

namespace Dao;

class ModeloMarcaDao implements MarcaModeloIDao
{
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

    public function traerTodo()
    {
        $sql = "SELECT marcas.nombre AS marca, modelos.nombre AS modelo 
                FROM modelos 
                    INNER JOIN marcas ON marcas.idMarca = modelos.idMarca";

        $conexion = Conexion::conectar();

        $sentencia = $conexion->prepare($sql);

        $sentencia->execute();

        $dataSet = $sentencia->fetchAll(\PDO::FETCH_ASSOC);

        if (!empty($dataSet)) {
            return $dataSet;
        }
        return null;
    }
}

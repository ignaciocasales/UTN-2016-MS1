<?php

namespace Dao;

class Conexion
{

    # Métodos

    public function conectar()
    {
        return new \PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASS);
    }
}
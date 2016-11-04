<?php

namespace Dao;

class Conexion
{

    # Métodos

    public function conectar()
    {
        //esta es mi version del conectar, creo es mas optimo y mas legible
        $host = DB_HOST;
        $db   = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

        $dsn = "mysql:host=$host;dbname=$db;";

        return new \PDO($dsn, $user, $pass);

        //la linea de abajo la hizo adrian...
        //return new \PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASS);
    }
}
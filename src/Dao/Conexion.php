<?php

namespace Dao;

class Conexion
{
    public static function conectar()
    {
        //esta es mi version del conectar, creo es mas optimo y mas legible
        $host = DB_HOST;
        $db = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

        $dsn = "mysql:host=$host;dbname=$db;";

        $dbh = new \PDO($dsn, $user, $pass, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));


        if ($dbh) {

            return $dbh;

        } else {

            throw new \PDOException;

        }
    }
}
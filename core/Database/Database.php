<?php

namespace Core\Database;

class Database
{

    public static function getPdo()
    {

        //DRIVER MYSQL PDO : sudo apt install php-mysql
        //DRIVER SQLITE PDO : sudo apt install php-sqlite3
        //supported : sqlite,mysql
        $type = "sqlite";
        $dbName = "test";
        $dbHost = "localhost";
        $dbUser = "mey";
        $dbPassword = "Ul140XgKzTUQ8";


        switch ($type):
            case "mysql":
                $dsn = "mysql:dbname=$dbName;host=$dbHost";
                break;
            case "sqlite":
                // you must create database.sqlite
                $dsn = "sqlite:../database.sqlite"; // Spécifiez le chemin vers votre fichier SQLite
                $dbUser = null;
                $dbPassword = null;
                break;
            default :
                throw new \Exception("Type de base de données non supporté.");

        endswitch;

        $pdo = new \PDO(
            $dsn,
            $dbUser,
            $dbPassword,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
            ]

        );
        $delimiter = strpos($dsn, ':');
        $language = substr($dsn, 0, $delimiter);


        return [
            "pdo" => $pdo,
            "bdd" => $language
        ];

    }

}
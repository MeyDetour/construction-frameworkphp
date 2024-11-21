<?php

namespace Core\Database;

use Core\Environnement\DotEnv;

class Database
{

    public static function getPdo()
    {

        //DRIVER MYSQL PDO : sudo apt install php-mysql
        //DRIVER PGSQL PDO :  sudo apt install php8.3-pgsql
        //DRIVER SQLITE PDO : sudo apt install php-sqlite3
        //supported : sqlite,mysql
        $dotenv = new DotEnv();
        $type = $dotenv->getVariable("DB_TYPE");
        $dbName = $dotenv->getVariable("DB_NAME");
        $dbHost = $dotenv->getVariable("DB_HOST");
        $dbPort = $dotenv->getVariable("DB_PORT");
        $dbUser = $dotenv->getVariable("DB_USER");
        $dbPassword = $dotenv->getVariable("DB_PASSWORD");

        switch ($type):
            case "mysql":
                $dsn = "mysql:dbname=$dbName;host=$dbHost";
                break;
            case "pgsql":
                $dsn = "pgsql:dbname=$dbName;host=$dbHost";
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
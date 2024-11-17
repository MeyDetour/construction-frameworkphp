<?php

namespace Core\Repository;

use Core\attributes\Table;
use Core\attributes\TargetEntity;
use Core\Database\Database;

abstract class Repository
{
    private $pdo;

    private $bdd;
    private $table;
    private $entity;

    public function __construct()
    {
        $this->bdd = Database::getPdo()['bdd'];
        $this->pdo = Database::getPdo()['pdo'];

        //get entity and then get table name trhough entity
        $this->entity = $this->getTargetEntity();
        $this->table = $this->getTargetTable();
    }


    public function getTargetEntity()
    {
        //The ReflectionClass class reports information about a class.
        // parameter $this to select the children repository class
        $reflection = new \ReflectionClass($this);

        //ex : PizzaRepository ( with class repository as abstract class ),  has "TargetEntity" as attribute, we get this attribute here
        // attributes = Array ( [0] => ReflectionAttribute Object ( ) )
        // attributes[0] = ReflectionAttribute Object ( )
        $attributes = $reflection->getAttributes(TargetEntity::class);

        //arguments = Array ( [name] => App\Entity\Pizza )
        $arguments = $attributes[0]->getArguments();

        $name = $arguments['name'];
        return $name;

    }

    public function getTargetTable()
    {
        $reflection = new \ReflectionClass($this->entity);
        $attributes  = $reflection->getAttributes( Table::class);
        $arguments = $attributes[0]->getArguments();
        $name = $arguments['name'];
        return $name;
    }

    public
    function findAll()
    {
        $query = $this->pdo->query('SELECT * FROM ' . $this->table);

        //Recuperer sous forme de tableau associatif
        $items = $query->fetchAll(\PDO::FETCH_CLASS,get_class( new $this->entity));
        return $items;
    }

    public
    function findOne($id)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch(\PDO::FETCH_CLASS,get_class(new $this->entity));
    }

    public
    function create(array $values)
    {
        try {

            $columnsNames = [];
            $columnsDatas = [];
            foreach ($values as $name => $value) {
                $columnsNames[] = $name;
                $columnsDatas[]  = ":$name";
            }
            $columnsNames = implode(',', $columnsNames);
            $columnsDatas = implode(',', $columnsDatas);
            //assert that this columns names are in entity


            $query = $this->pdo->prepare("INSERT INTO '.$this->table.' ($columnsNames) VALUES ($columnsDatas)");
            $query->execute($values);


            return null;

        } catch (\Exception $error) {
            return $error;
        }


    } function edit(array $values)
    {
        try {

            $columnsDatas = [];

            foreach ($values as $name => $value) {

                $columnsDatas[] = "$name = :$name" ;
            }
            $columnsDatas = implode(',', $columnsDatas);
            //assert that this columns names are in entity

            $query = $this->pdo->prepare("UPDATE '.$this->table.' SET $columnsDatas");
            $query->execute($values);


            return null;

        } catch (\Exception $error) {
            return $error;
        }


    }

    public function delete($id)
    {
        try {
            $query = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE id=:id');
            $query->execute(['id' => $id]);
            return null;
        } catch (\Exception $error) {
            return $error;
        }


    }
    //resolve target entity
    //resolvetablename
    //findall
    //Delete
    //find


}
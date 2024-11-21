<?php

namespace Core\Orm;

class Orm
{

    public function getAllEntity(){
        $entityFolder = __DIR__ . "/../Entity/";
        $entities = [];
        foreach (new \DirectoryIterator($entityFolder) as $file) {
            if ($file->isFile() && $file->getExtension() == "php") {
                $entities[] = substr($file->getFilename(), 0, -4);
            }
        }

        $entitiesObjects=[];
        foreach ($entities as $entity){
            $nameName = "App\\Entity\\".$entity;
            $entityObject = new $nameName();
            $entityObject[]=$entityObject;
        }


    }
}
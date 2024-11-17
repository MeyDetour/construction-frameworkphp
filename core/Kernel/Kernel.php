<?php

namespace Core\Kernel;

class Kernel
{
    public static function run(){
        $type = "home";
        $action= "index";
        if (!empty($_GET['type'])){$type = $_GET['type'];}
        if (!empty($_GET['action'])){$action = $_GET['action'];}

        $type = ucfirst($type);

        $controller = "App\\Controller\\".$type.'Controller';

        $controller = new $controller();
        $controller->$action();


    }

}
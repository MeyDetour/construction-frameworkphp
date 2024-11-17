<?php

namespace Core\Http;
use Core\View\View;
class Response
{
    public function render($tempalteName,array $data){
        View::render($tempalteName,$data);
        return $this;
    }
    public function redirect($route){
        if(!$route){
            header('Location: index.php');
        }else{
            header('Location: '.$route);
        }
        return $this;
    }

    public function renderError($error){
        View::renderError($error);
        return $this;
    }
}
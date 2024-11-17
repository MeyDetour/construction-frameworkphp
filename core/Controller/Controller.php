<?php

namespace Core\Controller;

use Core\Http\Response;

abstract class Controller
{
    private Response $response;

    public function __construct()
    {
        $this->response = new Response();
    }

    public function render($templateName, $data): Response
    {
        return $this->response->render($templateName, $data);
    }

    public function redirect($route): Response
    {
        return $this->response->redirect($route);
    }

    public function renderError($error): Response
    {
        return $this->response->renderError($error);
    }

    //get user
}
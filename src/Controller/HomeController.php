<?php

namespace App\Controller;

use App\Repository\PizzaRepository;
use Core\Controller\Controller;
use Core\Http\Request;
use Core\Http\Response;
use Core\View\View;

class HomeController extends Controller
{
    private $repository;
    private $request;

    public function __construct()
    {
        parent::__construct();
        $this->repository = new PizzaRepository();
        $this->request = new Request();
    }

    public function index()
    {
        $pizzas = $this->repository->findAll();

        return $this->render('home/index', ["pizzas" => $pizzas]);
    }

    public function create(): Response
    {
        if ($this->request->getMethod() == "POST") {

            if (!isset($_POST['name'])) {
                return $this->redirect('?type=home&action=index1');
            }
            $error = $this->repository->create([
                'name' => $_POST['name']
            ]);
            if ($error) {
                return $this->renderError($error);
            }

            return $this->redirect('?type=home&action=index');
        }

        return $this->render('pizza/create', []);
    }

    public function show()
    {
        if (!isset($_GET['id'])) {
            return $this->redirect('?type=home&action=index');
        }
        $pizza = $this->repository->findOne($_GET['id']);
        return $this->render('pizza/show', ["pizza" => $pizza]);
    }    public function delete()
    {
        if (!isset($_GET['id'])) {
            return $this->redirect('?type=home&action=index');
        }
        $error = $this->repository->delete($_GET['id']);
        if ($error) {
            return $this->renderError($error);
        }
        return $this->redirect('?type=home&action=index');
    }

    public function error($error)
    {
        return $this->render('error/error', ["error" => $error]);
    }
}
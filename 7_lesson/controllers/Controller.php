<?php


namespace App\controllers;


use App\engine\App;
use App\services\IRenderer;
use App\services\RendererTmplService;
use App\services\Request;
use App\services\TwigRendererService;

abstract class Controller
{
    private $action;
    protected $actionDefault = 'all';
    protected $app;
    protected $request;
    protected $isSingIn = 0;
    protected $isAdmin = 0;

    /**
     * Controller constructor.
     * @param App $app
     * @param Request $request
     */
    public function __construct(App $app, Request $request)
    {
        $this->app = $app;
        $this->request = $request;
        if (key_exists('Login', $_SESSION)){
            $this->isSingIn = $_SESSION['Login'];
        }
        if (key_exists('user', $_SESSION)){
            $this->checkForAdmin($_SESSION['user']);
        }
    }

    protected function checkForAdmin($user)
    {
        $this->isAdmin = $this->app->authService->isAdmin($user);
    }


    public function run($action)
    {
        $this->action = $action;
        if (empty($this->action)){
            $this->action = $this->actionDefault;
        }

        $method = $this->action . 'Action';
        if (!method_exists($this, $method)){
            return 'Error';
        }

        return $this->$method();
    }
    protected function getId()
    {
        return $this->request->getGet('id');
    }

    protected function getArticle()
    {
        return $this->request->getGet('article');
    }

    protected function getPage()
    {
        return $this->request->getGet('page');
    }

    public function render($template, $params = [])
    {
        return $this->app->renderer->render($template, $params);
    }
}

<?php


namespace App\controllers;


use App\services\IRenderer;
use App\services\RendererTmplService;
use App\services\TwigRendererService;

abstract class Controller
{
    private $action;
    protected $actionDefault = 'all';
    protected $renderer;

    /**
     * Controller constructor.
     * @param $renderer
     */
    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
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
        $id = 0;
        if(!empty((int)$_GET['id'])){
            $id = (int)$_GET['id'];
        }
        return $id;
    }

    protected function getArticle()
    {
        $article = '';
        if(!empty($_GET['article'])){
            $article = $_GET['article'];
        }
        return $article;
    }

    protected function getPage()
    {
        $page = 1;
        if(!empty($_GET['page'])){
            $page = $_GET['page'];
        }
        return $page;
    }

    public function render($template, $params = [])
    {
        return $this->renderer->render($template, $params);
    }
}

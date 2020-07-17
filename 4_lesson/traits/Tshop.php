<?php


namespace App\traits;


trait TShop
{
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
        $page = 0;
        if(!empty($_GET['page'])){
            $page = $_GET['page'];
        }
        return $page;
    }

    public function render($template, $params = [], $layout = 'main')
    {
        $content = $this->rendererTmpl($template, $params);
        $layout = 'layouts/' . $layout;
        return $this->rendererTmpl(
            $layout,
            [
                'content' => $content
            ]
        );
    }

    public function rendererTmpl($template, $params = [])
    {
        ob_start();
        extract($params);
        include dirname(__DIR__) .'/views/' . $template . '.php';
        return ob_get_clean();

    }

}

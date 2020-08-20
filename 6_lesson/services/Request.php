<?php


namespace App\services;


class Request
{
    private $requestString = '';
    private $controllerName = 'user';
    private $actionName = '';
    private $id = 0;
    private $page = 1;
    private $article = '';
    private $params = [
        'get' => [],
        'post' => [],
        'session' => [],
    ];

    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->prepareRequest();
    }

    protected function prepareRequest()
    {
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
        if (preg_match_all($pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];
        }

        $this->params = [
            'get' => $_GET,
            'post' => $_POST,
        ];
        if (!empty($_SESSION)) {
            $this->params['session'] = $_SESSION;
        }

//        if (!empty($_GET['id'])){
//            $this->id = (int)$_GET['id'];
//        }
//        if (!empty($_GET['page'])){
//            $this->page = (int)$_GET['page'];
//        }
//        if (!empty($_GET['article'])){
//            $this->article = $_GET['article'];
//        }
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return 'App\\controllers\\' . ucfirst($this->controllerName) . 'Controller';
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->actionName;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    public function post($value = '')
    {
        if (empty($value)) {
            return $this->params['post'];
        }
        return $this->params['post'][$value];
    }

    public function getGet($value = '')
    {
        if (empty($value)) {
            return $this->params['get'];
        }
        if (empty($this->params['get'][$value])) {
            $func = 'get' . ucfirst(trim($value));
            return $this->$func();
        }
        return $this->params['get'][$value];
    }

    public function getSession($firstKey = '', $secondKey = '')
    {
        if (empty($firstKey)) {
            return $this->params['session'];
        }
        if (empty($secondKey)) {
            if (!empty($this->params['session'][$firstKey])){
                return $this->params['session'][$firstKey];
            }
        }
        if (!empty($this->params['session'][$firstKey][$secondKey])) {
            return $this->params['session'][$firstKey][$secondKey];
        }
        return [];
    }

    public function clearSession($firstKey = '', $secondKey = '')
    {
        if (!empty($secondKey)) {
            unset($this->params['session'][$firstKey][$secondKey]);
            $_SESSION = $this->params['session'];
            return;
        }
        if (!empty($firstKey)) {
            unset($this->params['session'][$firstKey]);
            $_SESSION = $this->params['session'];
        }
        return;
    }

    public function isSingIn()
    {
        return $this->params['session']['Login'];
    }

    public function isAdmin()
    {
        return $this->params['session']['user']['is_admin'];
    }

    public function redirect($path = '')
    {
        if (!empty($path)) {
            header("Location: {$path}");
            return;
        }
        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: {$_SERVER['HTTP_REFERER']}");
            return;
        }
        header('Location: /');
    }

    public function prepareString($str)
    {
        return strip_tags(trim($str));
    }
}

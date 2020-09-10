<?php


namespace App\services;


class Request
{
    private $requestString = '';
    private $controllerName = 'user';
    private $actionName = '';
    private $urlparams = '';
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
            $this->urlparams = $matches['params'][0];
        }

        $this->params = [
            'get' => $_GET,
            'post' => $_POST,
        ];
//        if (!empty($_SESSION)) {
//            $this->params['session'] = $_SESSION;
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
    public function getParamsName(): string
    {
        return $this->urlparams;
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
            return $_SESSION;
        }
        if (empty($secondKey)) {
            if (!empty($_SESSION[$firstKey])){
                return $_SESSION[$firstKey];
            }
        }
        if (!empty($_SESSION[$firstKey]->$secondKey)) {
            return $_SESSION[$firstKey]->$secondKey;
        }
        if (!empty($_SESSION[$firstKey][$secondKey])){
            return $_SESSION[$firstKey][$secondKey];
        }
        return [];
    }

    public function setSession($firstKey = '', $secondKey = '', $data)
    {
        if (empty($firstKey)) {
            return $_SESSION = $data;
        }
        if (empty($secondKey)) {
            return $_SESSION[$firstKey] = $data;
        }
        return $_SESSION[$firstKey][$secondKey] = $data;
    }

    public function clearSession($firstKey = '', $secondKey = '')
    {
        if (!empty($secondKey)) {
            unset($_SESSION[$firstKey][$secondKey]);
            return;
        }
        if (!empty($firstKey)) {
            unset($_SESSION[$firstKey]);
        }
        return;
    }

//    public function isSingIn()
//    {
//        if(!empty($_SESSION['Login'])){
//            return $_SESSION['Login'];
//        }
//        return null;
//    }

    public function isAdmin()
    {
        if($_SESSION['user']['is_admin'] != null){
            return $_SESSION['user']['is_admin'];
        }
        return null;
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

<?php


namespace App\services;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRendererService implements IRenderer
{
    /**
     * @var \Twig\Environment $twig
     */
    protected $twig;

//    /**
//     * TwigRendererService constructor.
//     * @param \Twig\Environment $twig
//     */
//    public function __construct(\Twig\Environment $twig)
//    {
//        $this->twig = new Environment();
//    }



    public function render($template, $params = [])
    {
        $template = $template . '.twig';
        $loader = new FilesystemLoader('../views/');
        $this->getTwig($loader, $params);
        return $this->twig->render($template, $params);
    }




    protected function getTwig($loader, $params)
    {
        $this->twig = new Environment($loader, $params);
    }


}

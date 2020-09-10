<?php


namespace App\services;


use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class TwigRendererService implements IRenderer
{
    /**
     * @var \Twig\Environment $twig
     */
    protected $twig;


    /**
     * TwigRendererService constructor.
     */
    public function __construct()
    {
        $loader = new FilesystemLoader([
            dirname(__DIR__) . '/views',
            dirname(__DIR__) . '/views/layouts',
        ]);
        $this->twig = new Environment(
            $loader,
            [
                'debug' => true
            ]
        );
        $this->twig->addExtension(new DebugExtension());
    }

    /**
     * @param $template
     * @param array $params
     * @return string
     */
    public function render($template, $params = [])
    {
        $template .= '.twig';
        try {
            return $this->twig->render($template, $params);
        } catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
}

<?php


namespace App\services;


class RendererTmplService implements IRenderer
{
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

<?php
/**
 * Created by PhpStorm.
 * User: mojtaba
 * Date: 23/11/2025
 * Time: 07:07 PM
 */

namespace app\core;


class View
{
    public string $title = '';

    public function renderView(string $view, $params = [])
    {
        $viewContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->layoutContent();
        return str_replace('{content}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$APP->controller->layout ?? Application::$APP->layout;
        ob_start();
        include_once Application::$ROOT_DIR . "\\views\\layouts\\$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView(string $view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "\\views\\$view.php";
        return ob_get_clean();
    }
}
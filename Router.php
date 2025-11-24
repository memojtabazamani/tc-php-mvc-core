<?php

namespace crazyprogrammer\phpmvc;

use app\controllers\Controller;
use crazyprogrammer\phpmvc\exception\NotFoundException;
use crazyprogrammer\phpmvc\Request;

class Router
{
    protected array $routes = [
        'GET' => [
            '/' => 'home',
            '/contact' => 'contact'
        ]
    ];
    public $request;
    public $response;
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param $path
     * @param $callback
     * @return void
     */
    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return Application::$APP->view->renderView($callback);
        }

        if (is_array($callback)) {
            /**
             * @var $controller Controller
             * */
            $controller = new $callback[0]();
            $controller->action = $callback[1];
            $callback[0] = $controller;
            Application::$APP->controller = $controller;
            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }
        return call_user_func($callback, $this->request, $this->response);
    }
}
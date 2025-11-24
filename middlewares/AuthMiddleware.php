<?php
/**
 * Created by PhpStorm.
 * User: mojtaba
 * Date: 19/11/2025
 * Time: 06:32 PM
 */

namespace crazyprogrammer\phpmvc\middlewares;


use crazyprogrammer\phpmvc\Application;
use crazyprogrammer\phpmvc\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
    public array $actions = [];
    public function __construct(array $actions)
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if(Application::isGuest()) {
            if(empty($this->actions) || in_array(Application::$APP->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}
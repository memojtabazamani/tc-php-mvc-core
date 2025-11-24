<?php
/**
 * Created by PhpStorm.
 * User: mojtaba
 * Date: 19/11/2025
 * Time: 06:30 PM
 */

namespace app\core\middlewares;


abstract class BaseMiddleware
{
    abstract public function execute();
}
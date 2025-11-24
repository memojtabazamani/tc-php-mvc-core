<?php
/**
 * Created by PhpStorm.
 * User: mojtaba
 * Date: 19/11/2025
 * Time: 06:40 PM
 */

namespace app\core\exception;


class ForbiddenException extends \Exception
{
    protected $code = 403;
    protected $message = 'You don\'t have permission to access this page';
}
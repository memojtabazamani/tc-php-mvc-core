<?php
/**
 * Created by PhpStorm.
 * User: mojtaba
 * Date: 19/11/2025
 * Time: 07:03 PM
 */

namespace crazyprogrammer\phpmvc\exception;


class NotFoundException extends \Exception
{

    protected $code = 404;
    protected $message = 'Page Not Found!!';
}
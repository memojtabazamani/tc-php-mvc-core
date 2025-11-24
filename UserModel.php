<?php
/**
 * Created by PhpStorm.
 * User: mojtaba
 * Date: 18/11/2025
 * Time: 09:02 PM
 */

namespace app\core;


use app\core\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}
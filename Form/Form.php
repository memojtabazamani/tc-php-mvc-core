<?php

namespace crazyprogrammer\phpmvc\Form;

use app\models\Model;

class Form
{
    /**
     * @param $action
     * @param $method
     * @return Form
     */
    public static function begin($action, $method): Form
    {
        echo sprintf("<form action='%s' method='%s'>", $action, $method);
        return new Form();
    }

    public static function end()
    {
        echo "</form>";
    }

    /**
     * @param Model $model
     * @param $attribiute
     * @return InputField
     */
    public function field(Model $model, $attribiute)
    {
        return new InputField($model, $attribiute);
    }
}
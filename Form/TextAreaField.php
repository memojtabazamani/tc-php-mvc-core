<?php
/**
 * Created by PhpStorm.
 * User: mojtaba
 * Date: 23/11/2025
 * Time: 07:46 PM
 */

namespace app\core\Form;


class TextAreaField extends BaseField
{

    public function renderInput(): string
    {
        return sprintf('<textarea name="%s" class="form-control %s">%s</textarea>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            htmlspecialchars((string)$this->model->{$this->attribute}),

            );
    }
}
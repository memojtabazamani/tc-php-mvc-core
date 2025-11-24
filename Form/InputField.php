<?php
declare(strict_types=1);

namespace crazyprogrammer\phpmvc\Form;

use app\models\Model;

class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    private string $type;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    /**
     * @return $this
     */
    public function passwordField(): InputField
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function renderInput(): string
    {
        return sprintf('
        <input
                    type="%s"
                    name="%s"
                    value="%s"
                    class="form-control %s"
                    id="%s"
                    placeholder=""
                >',
            $this->type,
            $this->attribute,
            htmlspecialchars((string)$this->model->{$this->attribute}),
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->attribute,
            );
    }
}
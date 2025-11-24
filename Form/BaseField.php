<?php
/**
 * Created by PhpStorm.
 * User: mojtaba
 * Date: 23/11/2025
 * Time: 07:36 PM
 */

namespace app\core\Form;


use app\models\Model;

abstract class BaseField
{
    protected Model $model;
    protected string $attribute;
    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    abstract public function renderInput();

     public function __toString(): string
     {

         return sprintf('
            <div class="mb-3 form-group">
                <label for="%s" class="form-label">%s</label>  
                %s   
                <div class="invalid-feedback %s">%s</div>
            </div>',
             $this->attribute,
             $this->model->getLabel($this->attribute),
             $this->renderInput(),
             $this->model->hasError($this->attribute) ? 'd-block' : '',
             htmlspecialchars($this->model->getFirstError($this->attribute))
         );
     }
}
<?php

namespace App\Core\Form;

use App\Core\Model;

abstract class BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_EMAIL = 'email';
    public const TYPE_NUMBER = 'number';
    public const TYPE_PASSWORD = 'password';

    public string $type;
    public Model $model;
    public string $attribute;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }


    abstract public function renderInput(): string;


    public function __toString()
    {

        return sprintf(
            '<div class="col">
            <div class="mb-2">
                <label class="form-label">%s</label>
                    %s
                        <div class="invalid-feedback">
    
                             %s
    
                         </div>
            </div>
        </div>',
            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}

<?php


namespace app\core\Forms;


use app\core\Model;

class TextAreaField extends BaseField
{

    /**
     * Field constructor.
     *
     * @param  \app\core\Model  $model
     * @param  string  $attribute
     */
    public function __construct(Model $model, $attribute)
    {
        parent::__construct($model, $attribute);
    }

    public function renderInput(): string
    {
        return sprintf('<textarea name = "%s" class="form-control %s" >%s</textarea>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->{$this->attribute},
        );

    }

}

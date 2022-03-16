<?php


namespace app\core\Forms;


use app\core\Model;

class InputField extends BaseField
{

    /**
     * Field constructor.
     *
     * @param  \app\core\Model  $model
     * @param  string  $attribute
     */
    public function __construct(Model $model, $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function renderInput(): string
    {
        return sprintf('<input type = "%s" name = "%s" value = "%s" class="form-control %s" >',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
        );

    }

}

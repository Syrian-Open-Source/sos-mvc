<?php


namespace app\core\Forms;


use app\core\Model;

class Field extends BaseField
{

    public Model $model;
    public string $attribute;

    /**
     * Field constructor.
     *
     * @param  \app\core\Model  $model
     * @param  string  $attribute
     */
    public function __construct(Model $model, $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf('
        <div class="mb-3">
               <label class="form-label">%s</label>
               %s
               <div class="invalid-feedback">
                   %s
               </div>
        </div>
        ',
            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getError($this->attribute)
        );
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function type(string $type)
    {
        $this->type = $type;
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

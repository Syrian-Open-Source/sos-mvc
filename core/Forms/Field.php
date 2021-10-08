<?php


namespace app\core\Forms;


use app\core\Model;

class Field
{

    const TYPE_TEXT = 'text';
    const TYPE_PASSWORD = 'password';
    const TYPE_EMAIL = 'email';
    const TYPE_DATE = 'date';
    const TYPE_COLOR = 'color';
    const TYPE_TIME = 'time';

    public Model $model;
    public string $attribtue;

    /**
     * Field constructor.
     *
     * @param  \app\core\Model  $model
     * @param  string  $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribtue = $attribute;
    }

    public function __toString()
    {
        return sprintf('
        <div class="mb-3">
               <label class="form-label">%s</label>
               <input type="%s" name="%s" value="%s" class="form-control %s">
               <div class="invalid-feedback">
                   %s
               </div>
        </div>
        ',
            $this->attribtue,
            $this->type,
            $this->attribtue,
            $this->model->{$this->attribtue},
            $this->model->hasError($this->attribtue) ? 'is-invalid' : '',
            $this->model->getError($this->attribtue)
        );
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

}

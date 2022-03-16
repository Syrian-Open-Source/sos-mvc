<?php


namespace app\core\Forms;


use app\core\Model;

abstract class BaseField
{
    const TYPE_TEXT = 'text';
    const TYPE_PASSWORD = 'password';
    const TYPE_EMAIL = 'email';
    const TYPE_DATE = 'date';
    const TYPE_COLOR = 'color';
    const TYPE_TIME = 'time';
    public Model $model;
    public string $attribute;
    /**
     *
     * @author karam mustafa
     * @var string
     */
    protected string $type;

    abstract public function renderInput(): string;

    public function __construct(Model $model, string $attribute)
    {
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

    public function type(string $type)
    {
        $this->type = $type;
        return $this;
    }

}

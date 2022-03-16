<?php


namespace app\core\Forms;


use app\core\Model;

/**
 * Class BaseField
 *
 * @author karam mustafa
 * @package app\core\Forms
 */
abstract class BaseField
{
    /**
     * @var string
     */
    const TYPE_TEXT = 'text';
    /**
     * @var string
     */
    const TYPE_PASSWORD = 'password';
    /**
     * @var string
     */
    const TYPE_EMAIL = 'email';
    /**
     * @var string
     */
    const TYPE_DATE = 'date';
    /**
     * @var string
     */
    const TYPE_COLOR = 'color';
    /**
     * @var string
     */
    const TYPE_TIME = 'time';
    /**
     *
     * @author karam mustafa
     * @var \app\core\Model
     */
    public Model $model;
    /**
     *
     * @author karam mustafa
     * @var string
     */
    public string $attribute;
    /**
     *
     * @author karam mustafa
     * @var string
     */
    protected string $type;

    /**
     * description
     *
     * @return string
     * @author karam mustafa
     */
    abstract public function renderInput(): string;

    /**
     * BaseField constructor.
     *
     * @param  \app\core\Model  $model
     * @param  string  $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    /**
     * description
     *
     * @return string
     * @author karam mustafa
     */
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

    /**
     * description
     *
     * @param  string  $type
     *
     * @return $this
     * @author karam mustafa
     */
    public function type(string $type)
    {
        $this->type = $type;
        return $this;
    }

}

<?php


namespace app\core\Forms;


use app\core\Model;

class Form
{

    public static function open(...$args)
    {
        echo sprintf('<form action="%s" method="%s">', ...$args);
        return new Form();
    }

    /**
     * description
     *
     * @author karam mustafa
     */
    public function close()
    {
        echo '</form>';
    }

    /**
     * description
     *
     * @param  \app\core\Model  $model
     * @param $attributes
     *
     * @return \app\core\Forms\InputField
     * @author karam mustafa
     */
    public function field(Model $model, $attributes)
    {
        return new InputField($model, $attributes);
    }

    /**
     * description
     *
     * @param  \app\core\Model  $model
     * @param $attributes
     *
     * @return \app\core\Forms\TextAreaField
     * @author karam mustafa
     */
    public function textAreaField(Model $model, $attributes)
    {
        return new TextAreaField($model, $attributes);
    }
}

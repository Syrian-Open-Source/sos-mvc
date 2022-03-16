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

    public function close()
    {
        echo '</form>';
    }

    public function field(Model $model, $attributes)
    {
        return new InputField($model, $attributes);
    }
    public function textAreaField(Model $model, $attributes)
    {
        return new TextAreaField($model, $attributes);
    }
}

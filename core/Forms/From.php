<?php


namespace app\core\Forms;


use app\core\Model;

class From
{

    public static function begin(...$args)
    {
        echo sprintf('<form action="%s" method="%s">', ...$args);
        return new From();
    }

    public function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attributes)
    {
        return new Field($model, $attributes);
    }
}

<?php


namespace app\core\Forms;


abstract class BaseField
{
    const TYPE_TEXT = 'text';
    const TYPE_PASSWORD = 'password';
    const TYPE_EMAIL = 'email';
    const TYPE_DATE = 'date';
    const TYPE_COLOR = 'color';
    const TYPE_TIME = 'time';

    abstract public function renderInput(): string ;
}

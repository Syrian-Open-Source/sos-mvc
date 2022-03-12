<?php


namespace app\models;


use app\core\Model;

class LoginForm extends Model
{

    public string $name = '';
    public string $password = '';

    /**
     * @inheritDoc
     */
    public function rules()
    {
       return [
           'name'=>[self::RULE_REQUIRED],
           'password'=>[self::RULE_REQUIRED],
       ];
    }

    /**
     * @inheritDoc
     */
    public function labels()
    {

    }
}

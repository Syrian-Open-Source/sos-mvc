<?php


namespace app\models;


use app\core\Model;

class RegisterModel extends Model
{

    public $name = '';
    public $password = '';
    public $confirmPassword = '';

    public function register()
    {
        echo 'register new success';
    }

    public function rules()
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'password' => [
                self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MATCH, 'match' => 'password']
            ],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }
}

<?php


namespace app\models;


use app\core\DbModel;

class User extends DbModel
{

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

    public function attributes(): array
    {
        return [
            'name',
            'password',
        ];
    }

    public function tableName(): string
    {
        return 'users';
    }
}

<?php


namespace app\models;


use app\core\DbModel;

class User extends DbModel
{

    public $name = '';
    public $password = '';
    public $confirmPassword = '';


    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function login(){

        $user = User::find(['name' => $this->name]);

        if ($user){
            $this->dispatchError('name', 'name does not exist.');
        }
    }
    public function rules()
    {
        return [
            'name' => [
                self::RULE_REQUIRED, [
                    'rule' => self::RULE_UNIQUE, 'class' => self::class
                ]
            ],
            'password' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => 5],
                [self::RULE_MATCH, 'match' => 'password']
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

    /**
     * @inheritDoc
     */
    public function labels()
    {
        return [
            'name' => 'full name',
            'password' => 'your password',
            'confirmPassword' => 'confirm password',
        ];
    }
}

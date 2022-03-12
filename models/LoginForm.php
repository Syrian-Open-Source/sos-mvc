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

    public function login(){

        $user = (new User)->find(['name' => $this->name]);

        if (!$user){
            $this->dispatchError('name', 'name does not exist.');
            return false;
        }

        if (!password_verify($this->password,$user->password)){
            $this->dispatchError('password', 'password is wrong');

            return false;
        }

        return $user;

    }

    /**
     * @inheritDoc
     */
    public function labels()
    {
        return [
            'name' => 'Your name',
            'password' => 'Password',
        ];
    }
}

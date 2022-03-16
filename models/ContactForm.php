<?php


namespace app\models;


use app\core\Model;

class ContactForm extends Model
{



    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    /**
     * @inheritDoc
     */
    public function labels()
    {
        return [
            'name' => 'Your name',
            'email' => 'Your email',
            'body' => 'Your message body',
        ];
    }
}

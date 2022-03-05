<?php


namespace app\core;


abstract class Model
{

    public const RULE_REQUIRED = 'required';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_EMAIL = 'email';
    public const RULE_UNIQUE = 'unique';

    public $errors = [];

    public $errorMessages = [
        self::RULE_REQUIRED => 'This field is required',
        self::RULE_EMAIL => 'This field must be valid email address',
        self::RULE_MIN => 'Min length of this field must be {min}',
        self::RULE_MAX => 'Max length of this field must be {max}',
        self::RULE_MATCH => 'This field must be the same as {match}',
        self::RULE_UNIQUE => 'Record with with this {field} already exists',
    ];

    public function load($data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules();

    public function validate()
    {
        foreach ($this->rules() as $attr => $rules) {
            $value = $this->{$attr};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName == self::RULE_REQUIRED && !$value) {
                    $this->dispatchError($attr, $ruleName);
                }
                if ($ruleName == self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->dispatchError($attr, $ruleName);
                }
                if ($ruleName == self::RULE_MIN && strlen($value) < $rule[self::RULE_MIN]) {
                    $this->dispatchError($attr, $ruleName, $rule);
                }
                if ($ruleName == self::RULE_MAX && strlen($value) > $rule[self::RULE_MAX]) {
                    $this->dispatchError($attr, $ruleName, $rule);
                }
                if ($ruleName == self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->dispatchError($attr, $ruleName, $rule);
                }
                if ($ruleName == self::RULE_UNIQUE) {
                    $this->dispatchError($attr, $ruleName, $rule);
                }
            }
        }

        return empty($this->errors);
    }

    private function dispatchError($attr, $ruleName, $rules = [])
    {
        $this->errors[$attr][] = $this->resolveValidationErrorMessages($ruleName, $rules);
    }

    private function resolveValidationErrorMessages(string $ruleName, $params = [])
    {
        $message = $this->errorMessages[$ruleName];
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        return $message;
    }

    public function hasError($attr)
    {
        return $this->errors[$attr] ?? false;
    }

    public function getError($attr)
    {
        return $this->errors[$attr][0] ?? '';
    }
}

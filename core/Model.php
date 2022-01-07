<?php


namespace app\core;


/**
 * Class Model
 *
 * @author karam mustafa
 * @package app\core
 */
abstract class Model
{

    /**
     * @var string
     */
    public const RULE_REQUIRED = 'required';
    /**
     *
     */
    public const RULE_MIN = 'min';
    /**
     * @var string
     */
    public const RULE_MAX = 'max';
    /**
     * @var string
     */
    public const RULE_MATCH = 'match';
    /**
     * @var string
     */
    public const RULE_EMAIL = 'email';
    /**
     * @var string
     */
    public const RULE_UNIQUE = 'unique';

    /**
     *
     * @author karam mustafa
     * @var array
     */
    public $errors = [];
    /**
     *
     * @author karam mustafa
     * @var array
     */
    public $attributes = [];

    /**
     *
     * @author karam mustafa
     * @var array
     */
    public $errorMessages = [
        self::RULE_REQUIRED => 'This field is required',
        self::RULE_EMAIL => 'This field must be valid email address',
        self::RULE_MIN => 'Min length of this field must be {min}',
        self::RULE_MAX => 'Max length of this field must be {max}',
        self::RULE_MATCH => 'This field must be the same as {match}',
        self::RULE_UNIQUE => 'Record with with this {field} already exists',
    ];

    /**
     * description
     *
     * @param $name
     *
     * @return mixed
     * @author karam mustafa
     */
    public function __get($name)
    {
        if (!property_exists(__CLASS__,$name)){
            $this->attributes[$name] = '';
        }

        return $this->attributes[$name];
    }

    /**
     * description
     *
     * @param  array  $data
     *
     * @author karam mustafa
     */
    public function load($data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * set model rule
     *
     * @return mixed
     * @author karam mustafa
     */
    abstract public function rules();

    /**
     * description
     *
     * @return array
     * @author karam mustafa
     */
    abstract public function labels();

    /**
     * description
     *
     * @return bool
     * @author karam mustafa
     */
    public function validate()
    {
        foreach ($this->rules() as $attr => $rules) {
            $value = $this->{$attr};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule['rule'] ?? $rule[0];
                }
                if ($ruleName == self::RULE_REQUIRED && !$value) {
                    $this->dispatchErrorForRule($attr, $ruleName);
                }
                if ($ruleName == self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->dispatchErrorForRule($attr, $ruleName);
                }
                if ($ruleName == self::RULE_MIN && strlen($value) < $rule[self::RULE_MIN]) {
                    $this->dispatchErrorForRule($attr, $ruleName, $rule);
                }
                if ($ruleName == self::RULE_MAX && strlen($value) > $rule[self::RULE_MAX]) {
                    $this->dispatchErrorForRule($attr, $ruleName, $rule);
                }
                if ($ruleName == self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->dispatchErrorForRule($attr, $ruleName, $rule);
                }
                if (is_array($rule) && ($ruleName) == self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $unique = $rule['attribute'] ?? $attr;
                    $tableName = $className::tableName();
                    $statement = Application::$instance->db->prepare("SELECT * FROM $tableName WHERE $unique = :attr ");
                    $statement->bindValue(':attr', $value);
                    $statement->execute();
                    $records = $statement->fetchObject();
                    if ($records) {
                        $this->dispatchErrorForRule($attr, self::RULE_UNIQUE, ['field' => $attr]);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    /**
     * description
     *
     * @param $attr
     * @param $ruleName
     * @param  array  $rules
     *
     * @author karam mustafa
     */
    private function dispatchErrorForRule($attr, $ruleName, $rules = [])
    {
        $this->errors[$attr][] = $this->resolveValidationErrorMessages($ruleName, $rules);
    }

    /**
     * description
     *
     * @param  string  $attr
     * @param  string  $message
     *
     * @author karam mustafa
     */
    public function dispatchError(string $attr, string $message)
    {
        $this->errors[$attr][] = $message;
    }

    /**
     * description
     *
     * @param  string  $ruleName
     * @param  array  $params
     *
     * @return mixed|string|string[]
     * @author karam mustafa
     */
    private function resolveValidationErrorMessages(string $ruleName, $params = [])
    {
        $message = $this->errorMessages[$ruleName];
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        return $message;
    }

    /**
     * description
     *
     * @param $attr
     *
     * @return bool|mixed
     * @author karam mustafa
     */
    public function hasError($attr)
    {
        return $this->errors[$attr] ?? false;
    }

    /**
     * get attribute label
     *
     * @param  string $key
     *
     * @return bool|mixed
     * @author karam mustafa
     */
    public function getLabel($key)
    {
        return $this->labels()[$key] ?? $key;
    }

    /**
     * get error details.
     *
     * @param $attr
     *
     * @return mixed|string
     * @author karam mustafa
     */
    public function getError($attr)
    {
        return $this->errors[$attr][0] ?? '';
    }
}

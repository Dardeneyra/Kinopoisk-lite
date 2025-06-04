<?php

namespace App\Kernel\Validator;

class Validator implements ValidatorInterface
{
    private array $errors = [];
    private array $data;

    public function validate(array $data, array $rules): bool
    {
        $this->errors = [];
        $this->data = $data;

        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                $ruleParts = explode(':', $rule);
                $ruleName = $ruleParts[0];
                $ruleValue = $ruleParts[1] ?? null;

                $error = $this->validateRule($field, $ruleName, $ruleValue);

                if ($error) {
                    $this->errors[$field][] = $error;
                }
            }
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    private function validateRule(string $field, string $ruleName, string $ruleValue = null): string|false
    {
        $value = $this->data[$field] ?? null;

        switch ($ruleName) {
            case 'required':
                if (empty($value)) {
                    return "Field $field is required";
                }
                break;

            case 'min':
                if (strlen((string)$value) < (int)$ruleValue) {
                    return "Field $field must be at least {$ruleValue} characters long";
                }
                break;

            case 'max':
                if (strlen((string)$value) > (int)$ruleValue) {
                    return "Field $field must be at most {$ruleValue} characters long";
                }
                break;

            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return "Field $field must be a valid email address";
                }
                break;
        }

        return false;
    }
}

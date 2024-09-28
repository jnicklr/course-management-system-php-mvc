<?php

namespace Framework;

use Framework\Exceptions\ValidationException;

class Validator
{
    private array $data;
    private array $rules;
    private array $errors;
    private array $errorMessages;

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function validate(): bool
    {
        foreach ($this->rules as $field => $rules){
            $value = $this->data[$field] ?? null;
            $rules = explode('|', $rules);

            foreach ($rules as $rule){
                $method = $this->getValidationMethod($rule);
                if (!$this->$method($field, $value)){
                    $this->errors[$field][] = $this->getErrorMessage($field, $rule);
                }
            }
        }

        if (!empty($this->errors)){
            throw new ValidationException(
                errors: $this->errors,
                code: 400
            );
        }

        return true;
    }

    public function setErrorMessages(array $messages): void
    {
        $this->errorMessages = $messages;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function getValidationMethod(string $rule): string
    {
        return 'validate'.ucfirst($rule);
    }

    private function getErrorMessage(string $field, string $rule): string
    {
        if (isset($this->errorMessages["$field.$rule"])){
            return $this->errorMessages["$field.$rule"];
        }
        return "O campo $field falhou na regra $rule.";
    }

    private function validateRequired(string $field, $value): bool
    {
        return !empty($value);
    }

    private function validateEmail(string $field, $value): bool
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)){
            filter_var($value, FILTER_SANITIZE_EMAIL);
            return true;
        }
        return false;
    }

    private function validateNumber(string $field, $value): bool
    {
        return is_numeric($value);
    }

    private function validateString(string $field, $value): bool
    {
        if (is_string($value)){
            filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            return true;
        }
        return false;
    }

    private function validateDate(string $field, $value): bool
    {
        return (bool)strtotime($value);
    }
}
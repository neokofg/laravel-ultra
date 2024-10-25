<?php

namespace App\Application\Services;

use App\Application\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

final readonly class ValidationService
{
    private array $rules;

    public function __construct()
    {
        $this->rules = ValidatorRules::getRules();
    }

    /**
     * Валидация данных на основе предоставленных ключей и обязательных полей.
     *
     * @param array $data Данные для валидации.
     * @param array $keys Ключи для валидации.
     * @param array $requiredFields Поля, которые должны быть обязательными.
     * @throws ValidationException Если валидация не пройдена.
     */
    public function validate(array $data, array $keys, array $requiredFields = []): void
    {
        $rules = [];

        foreach ($keys as $key) {
            if (isset($this->rules[$key])) {
                $rule = $this->rules[$key];
                $isRequired = in_array($key, $requiredFields);
                $rule = str_replace(':required', $isRequired ? 'required' : '', $rule);
                $rule = trim($rule, '|');
                $rules[$key] = $rule;
            }
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->toArray());
        }
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    // Допустимі теми звернення: ключ => підпис у формі
    public const TOPICS = [
        'purchase'   => 'Купівля гри',
        'activation' => 'Активація ключа',
        'refund'     => 'Повернення коштів',
        'other'      => 'Інше',
    ];

    public function authorize(): bool
    {
        return true;
    }

    // Прибирає пробіли, дужки та дефіси з телефону до перевірки
    protected function prepareForValidation(): void
    {
        if ($this->has('phone')) {
            $this->merge([
                'phone' => preg_replace('/[\s\-()]/', '', (string) $this->input('phone')),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'min:2', 'max:100'],
            'email'   => ['required', 'email', 'max:255'],
            'phone'   => ['required', 'regex:/^\+380\d{9}$/'],
            'topic'   => ['required', Rule::in(array_keys(self::TOPICS))],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Вкажіть ваше ім\'я.',
            'name.min'         => 'Ім\'я має містити щонайменше 2 символи.',
            'email.required'   => 'Вкажіть email.',
            'email.email'      => 'Введіть коректну адресу email.',
            'phone.required'   => 'Вкажіть номер телефону.',
            'phone.regex'      => 'Номер має бути у форматі +380501234567.',
            'topic.required'   => 'Оберіть тему звернення.',
            'topic.in'         => 'Обрано недопустиму тему звернення.',
            'message.required' => 'Напишіть текст повідомлення.',
            'message.min'      => 'Повідомлення має містити щонайменше 10 символів.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'min:2', 'max:100'],
            'email'   => ['required', 'email', 'max:255'],
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
            'message.required' => 'Напишіть текст повідомлення.',
            'message.min'      => 'Повідомлення має містити щонайменше 10 символів.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $current = $this->route('filter')?->filter_id;

        return [
            'filter_name' => [
                'required', 'string', 'max:100',
                Rule::unique('filter', 'filter_name')->ignore($current, 'filter_id'),
            ],
            'filter_description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'filter_name.required' => 'Вкажіть назву мітки.',
            'filter_name.unique'   => 'Мітка з такою назвою вже існує.',
        ];
    }
}

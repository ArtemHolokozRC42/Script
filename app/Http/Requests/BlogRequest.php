<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string', 'max:500'],
            'text'        => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:category,category_id'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'      => 'Вкажіть заголовок.',
            'title.max'           => 'Заголовок не має перевищувати 200 символів.',
            'category_id.exists'  => 'Обрана категорія не існує.',
        ];
    }
}

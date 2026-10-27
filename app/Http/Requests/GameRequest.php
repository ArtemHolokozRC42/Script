<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:150'],
            'genre'        => ['required', 'string', 'max:50'],
            'developer'    => ['required', 'string', 'max:100'],
            'price'        => ['required', 'numeric', 'min:0', 'max:9999.99'],
            'release_year' => ['required', 'integer', 'min:1970', 'max:' . (date('Y') + 1)],
            'description'  => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'        => 'Вкажіть назву гри.',
            'genre.required'        => 'Вкажіть жанр.',
            'developer.required'    => 'Вкажіть розробника.',
            'price.required'        => 'Вкажіть ціну.',
            'price.numeric'         => 'Ціна має бути числом.',
            'price.min'             => 'Ціна не може бути від\'ємною.',
            'release_year.required' => 'Вкажіть рік випуску.',
            'release_year.integer'  => 'Рік має бути цілим числом.',
            'release_year.min'      => 'Рік випуску не може бути раніше 1970.',
            'release_year.max'      => 'Рік випуску вказано занадто пізній.',
        ];
    }
}

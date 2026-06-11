<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertProfileRequest extends FormRequest
{
    /**
     * Indicates that all authenticated users may submit this form.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Returns the validation rules for creating or updating a profile.
     *
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'age' => ['required', 'integer', 'min:18', 'max:100'],
            'bio' => ['nullable', 'string', 'min:10', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'age.required' => 'Age is required.',
            'age.integer' => 'Age must be a whole number.',
            'age.min' => 'You must be at least 18 years old to use this app.',
            'age.max' => 'Age cannot exceed 100.',
        ];
    }
}
